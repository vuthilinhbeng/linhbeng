<?php
if (!defined('ABSPATH')) {
	exit;
}
/**
 * 
 *
 *
 * @author   mpay Team
 * @since    
 *
 */

require_once('class-mpay-base.php');
class WC_Gateway_Mpay_Momo extends WC_Base_Mpay
{
	public function __construct()
	{
		$this->bank_id                 = 'momo';
		$this->bank_name		  = 	__('Momo Wallet', 'bck-verify-bank-transfer');;

		// $this->icon               = apply_filters('woocommerce_payleo_icon', plugins_url('../assets/momo.png', __FILE__));
		$this->has_fields         = false;
		$this->method_title       = __('Scan code Momo', 'bck-verify-bank-transfer');
		$this->method_description = __('Make payment by money transfer via momo', 'bck-verify-bank-transfer');
		$this->title        = __('Payment Momo', 'bck-verify-bank-transfer');
		parent::__construct();
	}
	public function configure_payment()
	{
		$this->method_title       = __('Payment Momo', 'bck-verify-bank-transfer');
		$this->method_description = __('Make payment by bank transfer via Momo.', 'bck-verify-bank-transfer');
	}
	//@deprecated
	/*public function thankyou_page($order_id)
	{
		if ($this->instructions) {
			echo wp_kses_post(wpautop(wptexturize(wp_kses_post($this->instructions))));
		}
		global $wp_session;
		if (!isset($wp_session['tmp'])) {
			$wp_session['tmp'] = true;
		} else {
			$this->momo_details($order_id);
		}
	}
	*/
}
