<?php
/*
*
* WC AirPay Payment Gateway
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('QRC_Base_Payment_Up_Gateway')) return;

if (!class_exists('QRC_VietQR')) {
	class QRC_VietQR extends QRC_Base_Payment_Up_Gateway {
		/**
		* Class Construct
		*/
		public function __construct() {	
			$this->id = 'qr-vietqr';
			$this->label = 'VietQR';
			$this->app_slug = 'vietqr';
			
			parent::__construct();
		}
		
		public function get_title() {
			return 'VietQR';
		}
	}
}