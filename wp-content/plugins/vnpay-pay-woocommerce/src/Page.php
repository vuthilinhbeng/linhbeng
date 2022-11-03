<?php
/**
 * 
 * 
 * @author thangnh
 * @since  1.0.1
 */

namespace vnpay;

class Page
{
	
	protected $args;

	public function __construct($args)
	{
		
		$this->args = $args;
		$this->createPage();
	}

	public function createPage()
	{
		return wp_insert_post($this->args);
	}
}