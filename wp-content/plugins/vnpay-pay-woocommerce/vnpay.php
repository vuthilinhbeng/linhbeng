<?php
/**
 * Plugin Name: VNPAY
 * Description: Integrate VNPAY paygate into Woocommerce
 * Version: 1.0.3
 * Author: VNPAY
 * Author URI: http://vnpayment.vnpay.vn/
 * License: NHT
 */

use vnpay\Gateways\vnpayGateway;
use vnpay\Gateways\vnpayInternationalResponse;
use vnpay\Traits\Pages;

require 'vendor/autoload.php';
//require 'src/return.php';

/**
 */
class vnpay
{
	use vnpay\Traits\Pages;

	
	protected $shortcodes = array();

	
	protected $responses;

	public function __construct()
	{
		$this->constants();
		add_action('init', array($this, 'renderPages'));
		add_action('plugins_loaded', array($this, 'vnpayInit'));
		add_filter('woocommerce_locate_template', array($this, 'vnpayWoocommerceTemplates'), 10, 3);
		$this->loadModule();
		$this->responseListener();
	}

	
	public function constants()
	{
		$consts = array(
			'URL' => plugins_url('', __FILE__),
			'IMAGE' => plugins_url('/images', __FILE__)
		);

		foreach ($consts as $key => $value) {
			define($key, $value);
		}
	}

	
	public function vnpayInit()
	{
		add_filter('woocommerce_payment_gateways', array($this, 'addPaymentMethod'));
	}

	
	public function addPaymentMethod($methods)
	{
		$methods[] = 'vnpay\Gateways\vnpayGateway';
		return $methods;
	}


	public function loadModule()
	{
		$this->shortcodes[] = new vnpay\Shortcodes\Thankyou;
	}

	public function responseListener()
	{
		if (isset($_GET['type'])) {
			switch ($_GET['type']) {
				case 'international':
					$this->responses[] = new vnpayInternationalResponse;
					break;
				
			}
		}
	}

	
	public function renderPages()
	{
		$checkRenderPage = (!get_option('vnpay_settings')) ? false : get_option('vnpay_settings');
		if ($checkRenderPage != false) return;
		if (!empty($this->pages)) {
			foreach ($this->pages as $slug => $args) {
				$page = new vnpay\Page($args);
			}
			update_option('vnpay_settings', true);
		}
	}

	public function vnpayWoocommerceTemplates($template, $template_name, $template_path)
	{
		global $woocommerce;

		$_template = $template;

		if (!$template_path) $template_path = $woocommerce->template_url;

		$plugin_path  = __DIR__ . '/woocommerce/';

		$template = locate_template(
			array(
			  $template_path . $template_name,
			  $template_name
			)
		);

		if (!$template && file_exists( $plugin_path . $template_name))

		$template = $plugin_path . $template_name;

		if (!$template) $template = $_template;

		return $template;
	}
}

new vnpay;