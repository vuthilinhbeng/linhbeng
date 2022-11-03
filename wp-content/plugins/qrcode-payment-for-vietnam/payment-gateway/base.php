<?php
/*
*
* WC Base Payment Gateway
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('WC_Payment_Gateway')) return;

if (!class_exists('QRC_Base_Payment_Gateway')) {
	class QRC_Base_Payment_Gateway extends WC_Payment_Gateway {
		
		public static $log = false;		
		public static $log_enabled = false;
		
		
		/**
		* Class Construct
		*/
		public function __construct() {	
			$this->has_fields = false;
			$this->guide = 'https://go.bluecoral.vn/guide-for-qr-code-payment';
			$this->icon = plugins_url('qrcode-payment-for-vietnam/assets/images/'.$this->app_slug.'.png');		
			$this->method_description = sprintf(
				__('Show QRCode to pay via %s. Learn how to setting your <a href="%s" target="_blank">gateway integration information</a>.', 'qrcode-payment-for-vietnam'), 
				$this->label,
				$this->guide . '#' . $this->app_slug
			);			
			$this->supports = array('products',	'refunds',);	
			$this->order_button_text = sprintf(__('Proceed to %s', 'qrcode-payment-for-vietnam'), $this->get_method_title());
			$this->method_title = $this->get_method_title();
			$this->testmode = $this->get_option('testmode', 'no');
			$this->debug = $this->get_option('debug', 'no');
			$this->title = $this->get_option('title');
			$this->description = $this->get_option('description');
			$this->fullname = $this->get_option('fullname');
			$this->phone = $this->get_option('phone');
			$this->invoice_prefix = $this->get_option('invoice_prefix');
			
			$this->init_settings();
			$this->init_form_fields();
			
			// do
			add_action('woocommerce_update_options_payment_gateways_'.$this->id, array($this, 'process_admin_options'));
			add_action('woocommerce_thankyou_'.$this->id, array($this, 'thankyou_page'));
			add_action('woocommerce_view_order', array($this, 'thankyou_page'), 10, 1);
		}
		
		public function get_method_title() {
			return sprintf('%s QRCode', $this->get_title());
		}
	
		function admin_options() {
			if ($this->is_valid_for_use()) {
				parent::admin_options();
			} else { ?>
				<div class="inline error">
					<p>
						<strong><?php esc_html_e('Gateway disabled.', 'qrcode-payment-for-vietnam'); ?></strong>: <?php echo sprintf(__('%s does not support your store currency.', 'qrcode-payment-for-vietnam'), $this->get_method_title()); ?>
					</p>
				</div>
			<?php }
		}
		
		public function is_valid_for_use() {
			return in_array(
				get_woocommerce_currency(),
				apply_filters(
					'woocommerce_momo_supported_currencies',
					array('VND')
				),
				true
			);
		}		
		
		public function is_available() {
			return parent::is_available();
		}
		
		function _get_form_fields() {
			return array(
				'enabled' => array(
					'title' => __('Enable/Disable', 'qrcode-payment-for-vietnam'),
					'type' => 'checkbox',
					'label' => sprintf(__('Enable %s payment gateway', 'qrcode-payment-for-vietnam'), $this->label),
					'default' => 'no',
				),
				'title' => array(
					'title' => __('Title', 'qrcode-payment-for-vietnam'),
					'type' => 'text',
					'desc_tip' => true,
					'description' => __('This controls the title which the user sees during checkout.', 'qrcode-payment-for-vietnam'),
					'default' => $this->get_method_title(),
				),
				'description' => array(
					'title' => __('Description', 'qrcode-payment-for-vietnam'),
					'type' => 'text',
					'desc_tip' => true,
					'description' => __('This controls the description which the user sees during checkout.', 'qrcode-payment-for-vietnam'),
					'default' => sprintf(__('Pay via %s', 'qrcode-payment-for-vietnam'), $this->label),
				),
				'fullname' => array(
					'title' => __('Your name', 'qrcode-payment-for-vietnam'),
					'type' => 'text',
					'desc_tip' => true,
					'description' => sprintf(__('Your name in %s app', 'qrcode-payment-for-vietnam'), $this->label),
					'default' => '',
				),
				'phone' => array(
					'title' => __('Your phone number', 'qrcode-payment-for-vietnam'),
					'type' => 'text',
					'desc_tip' => true,
					'description' => sprintf(__('Your phone number in %s app', 'qrcode-payment-for-vietnam'), $this->label),
					'default' => '',
				),
				'invoice_prefix' => array(
					'title'       => __('Invoice prefix', 'qrcode-payment-for-vietnam'),
					'type'        => 'text',
					'desc_tip'    => true,
					'description' => __('Please enter a prefix for your invoice numbers.', 'qrcode-payment-for-vietnam'),
					'default'     => 'WC-',
				),
			);
		}
		
		public function init_settings() {
			parent::init_settings();
			
			$this->app_url = (!empty($this->app_slug)) ? $this->app_slug.'://' : '';
			$this->enabled = (!empty($this->settings['enabled']) && 'yes' === $this->settings['enabled']) ? 'yes' : 'no';
			$this->invoice_prefix = (empty($this->invoice_prefix)) ? 'WC-' : $this->invoice_prefix;
		}		
		
		function init_form_fields() {
			$this->form_fields = apply_filters('bc-qr-wc_get_form_fields_'.$this->id, $this->_get_form_fields());
		}	

		function process_payment($order_id = 0) {
			global $woocommerce;
			
			$order = new WC_Order($order_id);

			$order->update_status('on-hold', sprintf(__('Awaiting %s payment.', 'qrcode-payment-for-vietnam'), $this->get_method_title()));
			$woocommerce->cart->empty_cart();

			return array(
				'result' => 'success',
				'redirect' => $this->get_return_url($order),
			);
		}
		
		public function thankyou_page($order_id = 0) {
			$order = new WC_Order($order_id);
			$payment_getway = $this;
			
			if ($order->get_status() === 'completed' || $order->get_payment_method() !== $this->id) return;
			
			$file = apply_filters('bc-qr-wc_thankyou_page_template', trailingslashit(plugin_dir_path(__FILE__)).'../views/thankyou.php');
			
			if (file_exists($file)) require_once $file;
			
			return;
		}
	}
}