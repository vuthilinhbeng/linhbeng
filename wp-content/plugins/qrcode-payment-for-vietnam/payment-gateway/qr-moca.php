<?php
/*
*
* WC Moca Payment Gateway
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('QRC_Base_Payment_Up_Gateway')) return;

if (!class_exists('QRC_Moca')) {
	class QRC_Moca extends QRC_Base_Payment_Up_Gateway {
		/**
		* Class Construct
		*/
		public function __construct() {	
			$this->id = 'qr-moca';
			$this->label = 'Moca';	
			$this->app_slug = 'moca';
			
			parent::__construct();
		}
		
		public function get_title() {
			return 'Moca';
		}
	}
}