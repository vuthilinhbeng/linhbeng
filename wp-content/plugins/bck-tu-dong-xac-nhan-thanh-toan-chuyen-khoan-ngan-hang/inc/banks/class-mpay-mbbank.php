<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 
 *
 *
 * @author  Mpay Team
 * @since  
 *
 */
require_once('class-mpay-base.php');
class WC_Gateway_Mpay_Mbbank extends WC_Base_Mpay {

	public function __construct() {
		$this->bank_id 			  = 'mbbank';
		$this->bank_name		  = "MBBank";

		// $this->icon               = apply_filters( 'woocommerce_payleo_icon', plugins_url('../assets/mbbank.png', __FILE__ ) );
		$this->has_fields         = false;
		$this->method_title       = sprintf(__('Payment via %s', 'bck-verify-bank-transfer'), $this->bank_name);
		$this->method_description = __('Payment by bank transfer', 'bck-verify-bank-transfer');
		$this->title        = sprintf(__('Payment via %s', 'bck-verify-bank-transfer'), $this->bank_name);
        parent::__construct();
	}
	public function configure_payment()
	{
		$this->method_title       = sprintf(__('Payment via %s', 'bck-verify-bank-transfer'), $this->bank_name);
		$this->method_description = __('Make payment by bank transfer.', 'bck-verify-bank-transfer');
	}
}