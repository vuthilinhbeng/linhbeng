<?php
/*
*
* WC Momo Payment Gateway
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('QRC_Base_Payment_Gateway')) return;

if (!class_exists('QRC_Viettelpay')) {
	class QRC_Viettelpay extends QRC_Base_Payment_Gateway {
		/**
		* Class Construct
		*/
		public function __construct() {	
			$this->id = 'qr-viettelpay';
			$this->label = 'ViettelPay';	
			$this->app_slug = 'viettelpay';
			
			parent::__construct();
		}
		
		public function needs_setup() {
			return empty($this->phone);
		}
		
		public function get_title() {
			return 'ViettelPay';
		}
	}
}