<?php
/*
*
* Plugin Name: QRCode Payment for Vietnam
* Plugin URI: https://bluecoral.vn/plugin/momo-payment-for-vietnam
* Description: Integrate QR Code from VietQR, Momo, ZaloPay, AirPay, ViettelPay, Moca Payment Gateway for Woocommerce.
* Author: Blue Coral
* Author URI: https://bluecoral.vn
* Contributors: bluecoral, diancom1202, nguyenrom
* Version: 1.1
* Text Domain: qrcode-payment-for-vietnam
*
*/

if (!defined('ABSPATH')) exit; 

if (!class_exists('QRC_WC_Coral')) {
	class QRC_WC_Coral {
		/**
		* Class Construct
		*/
		public function __construct() {	
			$this->domain = 'qrcode-payment-for-vietnam';	
			$this->option_key = 'qrc_wc_gateway';
			
			add_action('admin_init', array($this, 'qrc_plugin_required'));
			add_action('plugins_loaded', array($this, 'qrc_load_plugin_textdomain'));
			
			// functions
			$this->qrc_register_payment_gateway();
			$this->qrc_shortcode();
		}
		
		
		/**
		* Require Woocommerce
		*/	
		function qrc_plugin_required() {
			if (is_admin() && current_user_can('activate_plugins') && !in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
				add_action('admin_notices', array($this, 'qrc_plugin_required_message'));
				
				deactivate_plugins(plugin_basename(__FILE__)); 
				
				if (isset($_GET['activate'])) unset($_GET['activate']);
			} else {	
				add_filter('plugin_action_links_'.plugin_basename(__FILE__), array($this, 'qrc_render_plugin_action_links'), 10, 1);
			}
		}
		
		function qrc_plugin_required_message() { 
			_e('<div class="error"><p><span>Sorry, but <strong>Momo Payment for Woocommerce</strong> requires <a href="https://wordpress.org/plugins/woocommerce/" target="_blank" style="color: #0073aa;text-decoration: none;">Woocommerce</a> to be installed and active.</span></p></div>');
		}
		
		function qrc_render_plugin_action_links($links = array()) {
			array_unshift($links, '<a href="'.admin_url('admin.php?page=wc-settings&tab=checkout').'">'.__('Settings').'</a>');
			
			return $links;
		}
		
		function qrc_load_plugin_textdomain() {
			load_plugin_textdomain($this->domain, false, $this->domain.'/languages');
		}
		
		
		/**
		* Payment gateway
		*/	
		function qrc_gateways() {
			return array(
				'QRC_VietQR',
				'QRC_Airpay',
				'QRC_Moca',
				'QRC_Momo',
				'QRC_Viettelpay',
				'QRC_Zalopay',
			);
		}
		function qrc_register_payment_gateway() {
			add_action('plugins_loaded', array($this, 'qrc_payment_gateway'));
			add_filter('woocommerce_payment_gateways', array($this, 'qrc_woocommerce_payment_gateways'), 10, 1);
		}
		
		function qrc_payment_gateway() {
			$files = glob(dirname(__FILE__).'/payment-gateway/*.php');
			
			foreach ($files as $file) {		
				require_once $file;
			}
		}
		
		function qrc_woocommerce_payment_gateways($gateways = array()) {
			foreach ($this->qrc_gateways() as $gateway) {	
				if (class_exists($gateway)) $gateways[] = $gateway;
			}
			
			return $gateways;
		}
		
		function qrc_woocommerce_admin_field_image_qr($value = '') {
			?>
			asdsadsadasd
			<?php 
		}
		
		
		/**
		* Shortcode
		*/	
		function qrc_shortcode() {
			add_shortcode('bc_qr_code', array($this, 'qrc_render_shortcode'));
		}
		
		function qrc_render_shortcode($args = array(), $content = '') {
			extract($args);
			
			if (empty($order_id)) return;
			
			$order = new WC_Order($order_id);	
			
			if (
				$order->get_status() === 'completed' ||
				!in_array(
					$order->get_payment_method(),
					array(					
						'qr-vietqr',
						'qr-airpay',
						'qr-moca',	
						'qr-momo',						
						'qr-viettelpay',					
						'qr-zalopay',
					)				
				)				
			) return; 
			
			// css
			wp_enqueue_style('qrc-style', plugins_url('qrcode-payment-for-vietnam/assets/css/style.css'), array(), false, 'all');
			
			// js
			wp_enqueue_script('qrc-qr-code', plugins_url('qrcode-payment-for-vietnam/assets/js/qrcode.min.js'), array('jquery'), '', true);
			wp_enqueue_script('qrc-sweetalert', plugins_url('qrcode-payment-for-vietnam/assets/js/sweetalert.min.js'), array('jquery'), '', true);
			wp_enqueue_script('qrc-script', plugins_url('qrcode-payment-for-vietnam/assets/js/script.js'), array('jquery'), '', true); 
			
			$data_code = $this->_get_data_code($order);
			
			$file = apply_filters(
				'bc-qr-wc_shortcode_'.$order->get_payment_method(),
				trailingslashit(plugin_dir_path(__FILE__)).'views/'.$order->get_payment_method().'.php'
			);
			
			if (file_exists($file)) { 
				require_once $file;
			} else {
				$data_flag = str_replace('qr-', '', $order->get_payment_method());
				$file = apply_filters(
					'bc-qr-wc_shortcode',
					trailingslashit(plugin_dir_path(__FILE__)).'views/qr-code.php'
				);
				
				if (file_exists($file)) require_once $file;
			}
		}
		
		function _get_data_code($order) {
			$code = '';
			$payment_gateways = WC_Payment_Gateways::instance();	
			$gateway_name = $order->get_payment_method();
			$gateway = ($payment_gateways->payment_gateways()[$gateway_name]) ?? false;
			
			if (!$gateway) return $code;
			
			switch ($gateway_name) {
				case 'qr-momo':
					$code = sprintf('2|99|%s|||0|0|0', $gateway->phone);
					break;
					
				case 'qr-viettelpay':
					$code = json_encode(
						array(
							'transAmountList' => array('0'),
							'trans_amount' => '0',
							'bankCode' => '',
							'transfer_type' => 'MYQR',
							'bankcodeList' => array('VTT'),
							'cust_mobile' => ''.$gateway->phone,
						)
					);
					break;
					
				default:
					$code = $gateway->image_qr;
			}
			
			return apply_filters('bc-qr-wc_get_data_code', $code, $order);
		}
	}
	
	new QRC_WC_Coral();
}