<?php

/**
 * Plugin Name: Thanh Toán Quét Mã QR Code Tự Động - MoMo, ViettelPay, VNPay và 40 ngân hàng Việt Nam
 * Plugin URI: https://bck.haibasoft.com/
 * Description: Tự động xác nhận thanh toán quét mã QR Code MoMo, ViettelPay, VNPay, Vietcombank, Vietinbank, Techcombank, MB, ACB, VPBank, TPBank..
 * Author: BCK Team
 * Author URI: https://haibasoft.com/
 * Text Domain: bck-verify-bank-transfer
 * Domain Path: /languages
 * Version: 2.0.1
 * License: GNU General Public License v3.0
 */

//use MpayPayment as GlobalMpayPayment;

if (!defined('ABSPATH')) {
	exit;
}
define('MPAY_DIR', plugin_dir_path(__FILE__));
define('MPAY_URL', plugins_url('/', __FILE__));
define('MPAY_TEST', 0);
//require(__DIR__."/lib/phpqrcode/qrlib.php");
require(__DIR__."/inc/functions.php");

class MpayPayment
{
	
	static $oauth_settings = array(
		//'email' => '',
	);
	static $default_settings = array(

		'bank_transfer'         =>
		array(
			'case_insensitive' => 'yes',
			'enabled' => 'yes',
			'title' => 'Chuyển khoản ngân hàng 24/7',
			'secure_token' => '',
			'transaction_prefix' => 'ABC',
			'acceptable_difference' => 1000,
			'authorization_code' => '',
			'viet_qr' => 'yes',

		),
		'bank_transfer_accounts' =>
		array(
			/*array(
				'account_name'   => '',
				'account_number' => '',
				'bank_name'      => '',
				'bin'      => 0,
				'connect_status'      => 0,
				'plan_status'      => 0,
				'is_show'      => 'yes',
			),*/
		),
		'order_status' =>
		array(
			'order_status_after_paid'   => 'wc-completed',
			'order_status_after_underpaid' => 'wc-processing',
		),

	);
	
	
	public function __construct()
	{
		// get the settings of the old version
		$this->domain = 'bck-verify-bank-transfer';
		add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));

		add_action('init', array($this, 'init'));

		register_activation_hook( __FILE__, array($this,'activate') );
		register_deactivation_hook( __FILE__, array($this,'deactivate') );

		$this->settings = self::get_settings();
	}

	function activate() {
		if( version_compare(phpversion(), '5.6', '<')  ) {
			wp_die('You need to update your PHP version. Require: PHP 5.6+');
		}
		wp_redirect(admin_url('admin.php?page=bck'));
	}
	function deactivate() {
		;
	}
	public function init()
	{
		if (class_exists('WooCommerce')) {
			// Run this plugin normally if WooCommerce is active
			// Load the localization featureUnderpaid

			$this->main();
			// Add "Settings" link when the plugin is active
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'add_settings_link'));
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) {
				$settings = array('<a href="https://huong-dan-bck.haibasoft.com/" target="_blank">' . __('Docs', 'woocommerce') . '</a>');
				$links    = array_reverse(array_merge($links, $settings));

				return $links;
			});
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) {
				#$settings = array('<a href="https://wordpress.org/support/plugin/bck-verify-bank-transfer/reviews/" target="_blank">' . __('Review', 'woocommerce') . '</a>');
				#$links    = array_reverse(array_merge($links, $settings));
				return $links;
			});
			// Đăng kí thêm trạng thái 
			add_filter('wc_order_statuses', array($this, 'add_order_statuses'));
			register_post_status('wc-paid', array(
				'label'                     => __('Paid', 'bck-verify-bank-transfer'),
				'public'                    => true,
				'exclude_from_search'       => false,
				'show_in_admin_all_list'    => true,
				'show_in_admin_status_list' => true,
				'label_count'               => _n_noop(__('Paid', 'bck-verify-bank-transfer') . ' (%s)', __('Paid', 'bck-verify-bank-transfer') . ' (%s)')
			));
			register_post_status('wc-underpaid', array(
				'label'                     =>  __('Underpaid', 'bck-verify-bank-transfer'),
				'public'                    => true,
				'exclude_from_search'       => false,
				'show_in_admin_all_list'    => true,
				'show_in_admin_status_list' => true,
				'label_count'               => _n_noop(__('Underpaid', 'bck-verify-bank-transfer') . ' (%s)', __('Underpaid', 'bck-verify-bank-transfer') . ' (%s)')
			));
			wp_enqueue_style('mpay-style', plugins_url('assets/css/style.css', __FILE__), array(), false, 'all');
			wp_enqueue_script('mpay-qrcode', plugins_url('assets/js/easy.qrcode.js', __FILE__), array('jquery'), '', true);
			if(is_admin() && isset($_GET['page']) && $_GET['page']=='bck') {
				wp_enqueue_script('mpay-js', plugins_url('assets/js/js.js', __FILE__), array('jquery'), '', true);
			}
			/*if(MPAY_TEST && is_dir(__DIR__.'/test/')) {
				wp_enqueue_style('hpc-test-style', plugins_url('test/test.css', __FILE__), array(), false, 'all');
				wp_enqueue_script('hpc-test-js', plugins_url('test/test.js', __FILE__), array('jquery'), '', true);
			}*/
			add_action('wp_ajax_nopriv_fetch_order_status_hpc', array($this, 'fetch_order_status'));
			add_action('wp_ajax_fetch_order_status_hpc', array($this, 'fetch_order_status'));
			//add_action('wp_ajax_nopriv_fetch_sync_order_mpay', array($this, 'fetch_sync_order_mpay'));
			//add_action('wp_ajax_fetch_sync_order_mpay', array($this, 'fetch_sync_order_mpay'));
			add_action('wp_ajax_nopriv_paid_order_hpc', array($this, 'pc_payment_handler'));
			add_action('wp_ajax_paid_order_hpc', array($this, 'pc_payment_handler'));

			//add_action('wp_ajax_nopriv_auth_app_hpc', array($this, 'auth_app_hpc'));
			//add_action('wp_ajax_auth_app_hpc', array($this, 'auth_app_hpc'));
			
			add_action('wp_ajax_nopriv_auth_sync_status_hpc', array($this, 'auth_sync_status_hpc'));
			add_action('wp_ajax_auth_sync_status_hpc', array($this, 'auth_sync_status_hpc'));

		} else {
			// Throw a notice if WooCommerce is NOT active
			add_action('admin_notices', array($this, 'notice_if_not_woocommerce'));
		}
	}

	//health check
	public function auth_sync_status_hpc() {
		wp_send_json(['oauth_status'=>!empty(self::oauth_get_settings()), 'timestamp'=> time()]);
		die();
	}

	
	public function fetch_order_status()
	{
		if(empty($_REQUEST['order_id']) || !is_numeric($_REQUEST['order_id'])) {
			echo 'wc-pending';die();
		}
		$order = wc_get_order($_REQUEST['order_id']);
		$order_data = $order->get_data();
		$status = esc_attr($order_data['status']);
		echo 'wc-' . esc_html($status);
		die();
	}
	public function add_order_statuses($order_statuses)
	{
		$new_order_statuses = array();
		// add new order status after processing
		foreach ($order_statuses as $key => $status) {
			$new_order_statuses[$key] = $status;
		}
		$new_order_statuses['wc-paid'] = __('Paid', 'bck-verify-bank-transfer');
		$new_order_statuses['wc-underpaid'] = __('Underpaid', 'bck-verify-bank-transfer');
		return $new_order_statuses;
	}
	//Hàm này có thể giúp tạo ra một class Bank mới.
	public function gen_payment_gateway($gatewayName)
	{
		// $newClass = new class extends WC_Gateway_Mpay_Base
		// {
		// }; //create an anonymous class
		// $newClassName = get_class($newClass); //get the name PHP assigns the anonymous class
		// class_alias($newClassName, $gatewayName); //alias the anonymous class with your class name
	}


	public function main()
	{

		if (is_admin()) {
			include(MPAY_DIR . 'inc/class-mpay-admin-page.php');
			$this->Admin_Page = new Mpay_Admin_Page();
		}
		$settings = self::get_settings();
		$this->settings = $settings;
		//add_action('woocommerce_api_' . self::$webhook_oauth2, array($this, 'mpay_oauth2_handler'));
		//add_action('woocommerce_api_' . self::$webhook_route, array($this, 'pc_payment_handler'));

		if ('yes' == $settings['bank_transfer']['enabled'] ) {
			// chỗ này e tách ra ngoài code cho clean mà nó k nhận (gộp woocommerce_payment_gateways)
			
			require_once(MPAY_DIR . 'inc/banks/class-mpay-acb.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-mbbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-techcombank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-timoplus.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vpbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vietinbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-ocb.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-tpbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vietcombank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-bidv.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-agribank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-lienviet.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-hdbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-msb.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-sacombank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-shb.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vib.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-scb.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-abbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-bacabank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-eximbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-namabank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-ncb.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-seabank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vietcapitalbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-cake.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-tnex.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-cimbbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-dongabank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-hsbc.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-baovietbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-oceanbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vietabank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vietbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-saigonbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-kienlongbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-pvcombank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-pulicbank.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vrbank.php');
			//require_once(MPAY_DIR . 'inc/banks/class-mpay-moca.php');
			//require_once(MPAY_DIR . 'inc/banks/class-mpay-shopeepay.php');
			//require_once(MPAY_DIR . 'inc/banks/class-mpay-smartpay.php');			
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vinid.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-vnpay.php');
			//require_once(MPAY_DIR . 'inc/banks/class-mpay-zalopay.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-momo.php');
			require_once(MPAY_DIR . 'inc/banks/class-mpay-viettelpay.php');

			#require_once(MPAY_DIR . 'inc/banks/class-mpay-vnptpay.php');
			//require_once(MPAY_DIR . 'inc/banks/class-mpay-mobifonepay.php');
			//require_once(MPAY_DIR . 'inc/banks/class-mpay-vtcpay.php');
			//require_once(MPAY_DIR . 'inc/banks/class-mpay-vimo.php');

			/*foreach ($settings['bank_transfer_accounts'] as $account) {
				//$bank_name = explode('-',$account);
				//if (isset($account['is_show']) && $account['is_show'] == 'yes') {
					if (strtolower($account['bank_name']) == 'momo')
						
					if (strtolower($account['bank_name']) == 'acb')
						
					if (strtolower($account['bank_name']) == 'mbbank')
						
					if (strtolower($account['bank_name']) == 'techcombank')
						
					if (strtolower($account['bank_name']) == 'timoplus')
						
					if (strtolower($account['bank_name']) == 'vpbank')
						
					if (strtolower($account['bank_name']) == 'vietinbank')
						
					if (strtolower($account['bank_name']) == 'ocb')
						
					if (strtolower($account['bank_name']) == 'tpbank')
						
					if (strtolower($account['bank_name']) == 'vietcombank')
						
					if (strtolower($account['bank_name']) == 'bidv')
						
					if (strtolower($account['bank_name']) == 'agribank')
						
				//}
			}*/
			add_filter('woocommerce_payment_gateways', function ($gateways) {
				$settings = self::get_settings();
				#$gateways[] = 'WC_Gateway_Mpay_Phone';
				$gateways[] = 'WC_Gateway_Mpay_ACB';
				$gateways[] = 'WC_Gateway_Mpay_Mbbank';
				$gateways[] = 'WC_Gateway_Mpay_Techcombank';
				$gateways[] = 'WC_Gateway_Mpay_TimoPlus';
				$gateways[] = 'WC_Gateway_Mpay_Vpbank';
				$gateways[] = 'WC_Gateway_Mpay_Vietinbank';
				$gateways[] = 'WC_Gateway_Mpay_OCB';
				$gateways[] = 'WC_Gateway_Mpay_TPbank';
				$gateways[] = 'WC_Gateway_Mpay_Vietcombank';
				$gateways[] = 'WC_Gateway_Mpay_BIDV';
				$gateways[] = 'WC_Gateway_Mpay_Agribank';
				$gateways[] = 'WC_Gateway_Mpay_Lienviet';
				$gateways[] = 'WC_Gateway_Mpay_Hdbank';				
				$gateways[] = 'WC_Gateway_Mpay_MSB';
				$gateways[] = 'WC_Gateway_Mpay_Sacombank';
				$gateways[] = 'WC_Gateway_Mpay_SHB';
				$gateways[] = 'WC_Gateway_Mpay_SCB';
				$gateways[] = 'WC_Gateway_Mpay_ABBank';
				$gateways[] = 'WC_Gateway_Mpay_BacABank';
				$gateways[] = 'WC_Gateway_Mpay_Eximbank';
				$gateways[] = 'WC_Gateway_Mpay_NamABank';
				$gateways[] = 'WC_Gateway_Mpay_NCB';
				$gateways[] = 'WC_Gateway_Mpay_SeABank';
				$gateways[] = 'WC_Gateway_Mpay_VietCapitalBank';
				$gateways[] = 'WC_Gateway_Mpay_Cake';
				$gateways[] = 'WC_Gateway_Mpay_Tnex';
				$gateways[] = 'WC_Gateway_Mpay_CIMBBank';
				$gateways[] = 'WC_Gateway_Mpay_DongABank';
				$gateways[] = 'WC_Gateway_Mpay_HSBC';
				$gateways[] = 'WC_Gateway_Mpay_BaovietBank';
				$gateways[] = 'WC_Gateway_Mpay_OceanBank';
				$gateways[] = 'WC_Gateway_Mpay_VietABank';
				$gateways[] = 'WC_Gateway_Mpay_VietBank';
				$gateways[] = 'WC_Gateway_Mpay_SaigonBank';
				$gateways[] = 'WC_Gateway_Mpay_Kienlongbank';
				$gateways[] = 'WC_Gateway_Mpay_PVcomBank';
				$gateways[] = 'WC_Gateway_Mpay_PulicBank';
				$gateways[] = 'WC_Gateway_Mpay_VRBank';
				
				$gateways[] = 'WC_Gateway_Mpay_ViettelPay';
				//$gateways[] = 'WC_Gateway_Mpay_Moca';
				$gateways[] = 'WC_Gateway_Mpay_Momo';
				//$gateways[] = 'WC_Gateway_Mpay_Shopeepay';
				//$gateways[] = 'WC_Gateway_Mpay_Smartpay';
				$gateways[] = 'WC_Gateway_Mpay_VIB';
				$gateways[] = 'WC_Gateway_Mpay_Vinid';
				$gateways[] = 'WC_Gateway_Mpay_Vnpay';
				//$gateways[] = 'WC_Gateway_Mpay_Zalopay';

				#$gateways[] = 'WC_Gateway_Mpay_VNPTPay';
				//$gateways[] = 'WC_Gateway_Mpay_MobiFonePay';
				//$gateways[] = 'WC_Gateway_Mpay_Vtcpay';
				//$gateways[] = 'WC_Gateway_Mpay_Vimo';
				

				/*foreach ($settings['bank_transfer_accounts'] as $account) {
					#if (strtolower($account['bank_name']) == 'momo')
						
					#if (strtolower($account['bank_name']) == 'acb')
						
					#if (strtolower($account['bank_name']) == 'mbbank')
						
					#if (strtolower($account['bank_name']) == 'techcombank')
						
					#if (strtolower($account['bank_name']) == 'timoplus')
						
					#if (strtolower($account['bank_name']) == 'vpbank')
						
					#if (strtolower($account['bank_name']) == 'vietinbank')
						
					#if (strtolower($account['bank_name']) == 'ocb')
						
					#if (strtolower($account['bank_name']) == 'tpbank')
						
					#if (strtolower($account['bank_name']) == 'vietcombank')
						
					#if (strtolower($account['bank_name']) == 'bidv')
						
					#if (strtolower($account['bank_name']) == 'agribank')
						
				}*/
				// print_r ($gateways);
				return $gateways;
			});
		}
	}
	public function notice_if_not_woocommerce()
	{
		$class = 'notice notice-warning';

		$message = __(
			'BCK is not running because WooCommerce is not active. Please activate both plugins.',
			'bck-verify-bank-transfer'
		);
		printf('<div class="%1$s"><p><strong>%2$s</strong></p></div>', $class, $message);
	}
	static function get_settings()
	{
		$settings = get_option('mpay', self::$default_settings);
		$settings = wp_parse_args($settings, self::$default_settings);
		return $settings;
	}
	static function update_settings(array $data) {
		if(!empty($data)) update_option('mpay', $data);
	}
	static function oauth_get_settings()
	{
		$settings = get_option('mpay_oauth', self::$oauth_settings);
		$settings = wp_parse_args($settings, self::$oauth_settings);
		return $settings;
	}
	static function get_bank_icon($name, $img=false) {
		//if(true || is_dir(MPAY_DIR.'/assets/'.$name.'.png')) return; 
		$url = MPAY_URL.'/assets/'.strtolower($name).'.png';
		return $img? '<img class="bck-bank-icon" title="'.strtoupper($name).'" src="'.$url.'"/>': $url;
	}
	static function noQRBankLogo($name) {
		return !in_array($name, ['momo','viettelpay']);
	}
	static function get_list_banks()
	{
		$banks = array(
			'acb' => 'ACB',
			'bidv' => 'BIDV',
			'mbbank' => 'MB Bank',
			'momo' => 'Momo',
			'ocb' => 'OCB',
			'timoplus' => 'Timo Plus',
			'tpbank' => 'TPBank',
			'vietcombank' => 'Vietcombank',
			'vpbank' => 'VPBank',
			'vietinbank' => 'Vietinbank',
			'techcombank' => 'Techcombank',
			'agribank' => 'Agribank',
			'viettelpay'=> 'ViettelPay',
			'hdbank'=> 'HDBank',
			'moca'=> 'Moca',
			'msb'=> 'MSB',
			'sacombank'=> 'Sacombank',
			'shb'=> 'SHB',
			'shopeepay'=> 'ShopeePay',
			'smartpay'=> 'SmartPay',
			'vib'=> 'VIB',
			'vinid'=> 'VinID',
			'vnpay'=> 'VNPay',
			'zalopay'=> 'ZaloPay',
		);
		return $banks;
	}

	static function get_list_bin()
	{
		$banks = array(
			'970416' => 'acb',
			'970418' => 'bidv',
			'970422' => 'mbbank',
			'970448' => 'ocb',
			'970454' => 'timoplus',
			'970423' => 'tpbank',
			'970436' => 'vietcombank',
			'970432' => 'vpbank',
			'970415' => 'vietinbank',
			'970407' => 'techcombank',
			'970405' => 'agribank',
			'970449' => 'lvp',
			'970437'=> 'hdbank',
			'970426'=> 'msb',
			'970429'=> 'sacombank',
			'970443'=> 'shb',
			'970441'=> 'vib',
			'970425' => 'abbank',
			'970409' => 'bacabank',
			'970438' => 'baovietbank',
			'422589' => 'cimbbank',
			'970406' => 'dongabank',
			'970431' => 'eximbank',
			'458761' => 'hsbc',
			'970452' => 'kienlongbank',
			'970422' => 'mbbank',
			'970428' => 'namabank',
			'970419' => 'ncb',
			'970414' => 'oceanbank',
			'970439' => 'pulicbank',
			'970412' => 'pvcombank',
			'970400' => 'saigonbank',
			'970429' => 'scb',
			'970440' => 'seabank',
			'970423' => 'tpbank',
			'970427' => 'vietabank',
			'970433' => 'vietbank',
			'970454' => 'vietcapitalbank',
			'970421' => 'vrbank',
		);
		return $banks;
	}
	static function connect_status_banks()
	{
		$status = array(
			'0' => __('Inactive', 'bck-verify-bank-transfer'),
			'1' =>  array(
				'0' => __('Active', 'bck-verify-bank-transfer'),
				'1' => __('Trial', 'bck-verify-bank-transfer'),
				'2' => __('Out of money', 'bck-verify-bank-transfer')
			)
		);
		return $status;
	}
	static function transaction_text($code, $settings) {
		if($settings==null) $settings = self::get_settings();
		$texts = !empty($settings['bank_transfer']['extra_text'])? $settings['bank_transfer']['extra_text']: '';
		if($texts) {
			$texts = array_filter(explode("\n", $texts));
			if(count($texts)) {
				return $texts[array_rand($texts)].' '. $code;
				//return (array_rand([1,0])==1)? $text. ' '. $code : $code.' '.$text;
			}
		}
		return $code;
	}

	public function add_settings_link($links)
	{
		$settings = array('<a href="' . admin_url('admin.php?page=bck') . '">' . __('Settings', 'bck-verify-bank-transfer') . '</a>');
		$links    = array_reverse(array_merge($links, $settings));

		return $links;
	}

	//run by webhook
	public function pc_payment_handler()
	{
		$txtBody = file_get_contents('php://input');
		$jsonBody = json_decode($txtBody); //convert JSON into array
		if (!$txtBody || !$jsonBody) {
			wp_send_json(['error'=>"Missing body"]) ;
			die();
		}
		if (isset($jsonBody->error) && $jsonBody->error != 0) {
			wp_send_json(['error'=> "An error occurred"]);
			die();
		}
		$header = hpc_getHeader();
		$token = isset($header["Secure-Token"])? $header["Secure-Token"]: '';
		if (strcasecmp($token, $this->settings['bank_transfer']['secure_token']) !== 0) {
			wp_send_json(['error'=> "Missing secure_token or wrong secure_token"]);
			die();
		}
		$result = ['msg'=>[],'error'=>1,'rawInput'=> $txtBody];

		if(!empty($jsonBody->data))
		foreach ($jsonBody->data as $key => $transaction) {
			$result['_ok']=1;	//detect webhook ok
			$des = $transaction->description;
			if(hpc_is_JSON($des)) {
				$desJson = is_string($des)? json_decode($des, true): $des;
				if(is_array($desJson)) {
					if(isset($desJson['code'])) {
						$des = $desJson['code'];
						//$update['bank_transfer']['code'] = $desJson['code'];
					}
					//if(isset($desJson['app'])) $update['bank_transfer']['app'] = $desJson['app'];
				}
			}
			$order_id = hpc_parse_order_id($des, $this->settings['bank_transfer']['transaction_prefix'], $this->settings['bank_transfer']['case_insensitive']);
			if (is_null($order_id)) {
				wp_send_json (['error'=>"Order ID not found from transaction content: " . $des . "\n"]);
				continue;
			}
			//echo ("Start processing orders with transaction code " . $order_id . "...\n");
			$order = wc_get_order($order_id);
			if (!$order) {
				continue;
			}
			if($order->get_status()=='completed') {
				$result['error']=0;
				$result['msg'][]= ("Transaction processed before " . $order_id . " success\n");
				break;
			}
			//echo(var_dump(wc_get_order_statuses()));
			$money = $order->get_total();
			$paid = $transaction->amount;
			/*$today = date_create(date("Y-m-d"));
			$date_transaction = date_create($transaction->when);
			$interval = date_diff($today, $date_transaction);
			if ($interval->format('%R%a') < -2) {
				# code...Giao dịch quá cũ, không xử lý
				wp_send_json (['error'=>__('Transaction is too old, not processed', 'bck-verify-bank-transfer')]);
				die();
			}*/
			$total = number_format($transaction->amount, 0);
			//$order_note = sprintf(__('BCK announces received <b>%s</b> VND, content <B>%s</B> has been moved to <b>Account number %s</b>', 'bck-verify-bank-transfer'), $total, $des, $transaction->subAccId);
			$order_note = "BCK thông báo nhận <b>{$total}</b> VND, nội dung <B>{$des}</B> chuyển vào <b>STK {$transaction->subAccId}</b>";
			$order->add_order_note($order_note);
			$order->update_meta_data('bck_ndck', $des);

			// $order_note_overpay = "mpay thông báo <b>{$total}</b> VND, nội dung <b>$des</b> chuyển khoản dư vào <b>STK {$transaction->subAccId}</b>";
			$acceptable_difference = abs($this->settings['bank_transfer']['acceptable_difference']);
			if ($paid < ($money  - $acceptable_difference>0? $money  - $acceptable_difference: $money )) {
				$order->add_order_note(__('The order is underpaid so it is not completed', 'bck-verify-bank-transfer'));
				$status_after_underpaid = $this->settings['order_status']['order_status_after_underpaid'];

				if ($status_after_underpaid && $status_after_underpaid != "wc-default") {
					$status = substr($this->settings['order_status']['order_status_after_underpaid'], 3);
					$order->update_status($status);
				}
				$result['error']=1;
				$result['msg'][] = __('The order is underpaid so it is not completed', 'bck-verify-bank-transfer');

			} else {
				$order->payment_complete();
				wc_reduce_stock_levels($order_id);
				$status_after_paid = $this->settings['order_status']['order_status_after_paid'];

				if ($status_after_paid && $status_after_paid != "wc-default") {
					$order->update_status($status_after_paid);
				}
				//NEU THANH TOAN DU THI GHI THEM 1 cai NOTE 
				if ($paid > $money + $acceptable_difference) {
					$order->add_order_note(__('Order has been overpaid', 'bck-verify-bank-transfer'));
					$result['msg'][] = __('Order has been overpaid', 'bck-verify-bank-transfer');
				}
				$result['error']=0;
				$result['msg'][]= ("Transaction processing  " . $order_id . " success\n");
			}
			
			//$result['success']=1;
			$order->save();
			if(empty($result['error'])) break;
		}
		$result['msg'] = join(". ", $result['msg']);
		wp_send_json($result);
		die();
		//TODO: Nghiên cứu việc gửi mail thông báo đơn hàng thanh toán hoàn tất.
	}
	
	function load_plugin_textdomain()
	{
		load_plugin_textdomain($this->domain, false, dirname(plugin_basename(__FILE__))  . '/languages');
	}
}
new MpayPayment();
