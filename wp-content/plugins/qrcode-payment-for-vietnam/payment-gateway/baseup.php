<?php
/*
*
* WC Baseup Payment Gateway
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('QRC_Base_Payment_Gateway')) return;

if (!class_exists('QRC_Base_Payment_Up_Gateway')) {
	class QRC_Base_Payment_Up_Gateway extends QRC_Base_Payment_Gateway {
		/**
		* Class Construct
		*/
		public function __construct() {
			// config
			$this->title = $this->get_option('title');
			$this->description = $this->get_option('description');
			$this->image_qr = $this->get_option('image_qr');
			
			parent::__construct();
		}
		
		public function needs_setup() {
			return empty($this->image_qr);
		}	
		
		public function admin_options() {
			parent::admin_options();
			
			wp_enqueue_media();
			wp_enqueue_script('qrc-admin', plugins_url('qrcode-payment-for-vietnam/assets/js/admin.js'), array('jquery'), '', true);
			
			echo '<span id="bc-qr-code-flag" data-id="woocommerce_'.$this->id.'_image_qr"></span>';
		}
		
		function _get_form_fields() {
			return array_merge(
				parent::_get_form_fields(),
				array(
					'image_qr' => array(
						'title' => __('QrCode', 'qrcode-payment-for-vietnam'),
						'type' => 'hidden',
						'desc_tip'    => true,
						'description' => sprintf(__('Your %s QrCode', 'qrcode-payment-for-vietnam'), $this->label),
						'default' => '',
					),
				)
			);
		}
	}
}