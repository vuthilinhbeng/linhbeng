<?php
/*
*
* WC AirPay Payment Gateway
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('QRC_Base_Payment_Up_Gateway')) return;

if (!class_exists('QRC_Airpay')) {
	class QRC_Airpay extends QRC_Base_Payment_Up_Gateway {
		/**
		* Class Construct
		*/
		public function __construct() {	
			$this->id = 'qr-airpay';
			$this->label = 'AirPay';
			$this->app_slug = 'airpay';
			
			parent::__construct();
		}
		
		public function get_title() {
			return 'AirPay';
		}
	}
}