<?php
/*
*
* WC Momo Payment Gateway
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('QRC_Base_Payment_Gateway')) return;

if (!class_exists('QRC_Momo')) {
	class QRC_Momo extends QRC_Base_Payment_Gateway {
		/**
		* Class Construct
		*/
		public function __construct() {	
			$this->id = 'qr-momo';
			$this->label = 'MoMo Wallet';
			$this->app_slug = 'momo';
			
			parent::__construct();
		}
		
		public function needs_setup() {
			return empty($this->phone);
		}
		
		public function get_title() {
			return 'MoMo';
		}
	}
}