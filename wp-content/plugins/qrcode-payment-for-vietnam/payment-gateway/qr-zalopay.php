<?php
/*
*
* WC ZaloPay Payment Gateway
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('QRC_Base_Payment_Up_Gateway')) return;

if (!class_exists('QRC_Zalopay')) {
	class QRC_Zalopay extends QRC_Base_Payment_Up_Gateway {
		/**
		* Class Construct
		*/
		public function __construct() {	
			$this->id = 'qr-zalopay';
			$this->label = 'ZaloPay';
			$this->app_slug = 'zalopay';
			
			parent::__construct();
		}
		
		public function get_title() {
			return 'ZaloPay';
		}
	}
}