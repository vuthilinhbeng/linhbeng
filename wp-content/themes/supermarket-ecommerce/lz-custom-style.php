<?php 

	$supermarket_ecommerce_custom_style = '';

	// Logo Size
	$supermarket_ecommerce_logo_top_padding = get_theme_mod('supermarket_ecommerce_logo_top_padding');
	$supermarket_ecommerce_logo_bottom_padding = get_theme_mod('supermarket_ecommerce_logo_bottom_padding');
	$supermarket_ecommerce_logo_left_padding = get_theme_mod('supermarket_ecommerce_logo_left_padding');
	$supermarket_ecommerce_logo_right_padding = get_theme_mod('supermarket_ecommerce_logo_right_padding');

	if( $supermarket_ecommerce_logo_top_padding != '' || $supermarket_ecommerce_logo_bottom_padding != '' || $supermarket_ecommerce_logo_left_padding != '' || $supermarket_ecommerce_logo_right_padding != ''){
		$supermarket_ecommerce_custom_style .=' .logo {';
			$supermarket_ecommerce_custom_style .=' padding-top: '.esc_attr($supermarket_ecommerce_logo_top_padding).'px; padding-bottom: '.esc_attr($supermarket_ecommerce_logo_bottom_padding).'px; padding-left: '.esc_attr($supermarket_ecommerce_logo_left_padding).'px; padding-right: '.esc_attr($supermarket_ecommerce_logo_right_padding).'px;';
		$supermarket_ecommerce_custom_style .=' }';
	}

	// Product section padding
	$supermarket_ecommerce_product_section_padding = get_theme_mod('supermarket_ecommerce_product_section_padding');

	if( $supermarket_ecommerce_product_section_padding != ''){
		$supermarket_ecommerce_custom_style .=' #product_section {';
			$supermarket_ecommerce_custom_style .=' padding-top: '.esc_attr($supermarket_ecommerce_product_section_padding).'px; padding-bottom: '.esc_attr($supermarket_ecommerce_product_section_padding).'px;';
		$supermarket_ecommerce_custom_style .=' }';
	}

	// Site Title Font Size
	$supermarket_ecommerce_site_title_font_size = get_theme_mod('supermarket_ecommerce_site_title_font_size');
	if( $supermarket_ecommerce_site_title_font_size != ''){
		$supermarket_ecommerce_custom_style .=' .logo h1.site-title, .logo p.site-title {';
			$supermarket_ecommerce_custom_style .=' font-size: '.esc_attr($supermarket_ecommerce_site_title_font_size).'px;';
		$supermarket_ecommerce_custom_style .=' }';
	}

	// Site Tagline Font Size
	$supermarket_ecommerce_site_tagline_font_size = get_theme_mod('supermarket_ecommerce_site_tagline_font_size');
	if( $supermarket_ecommerce_site_tagline_font_size != ''){
		$supermarket_ecommerce_custom_style .=' .logo p.site-description {';
			$supermarket_ecommerce_custom_style .=' font-size: '.esc_attr($supermarket_ecommerce_site_tagline_font_size).'px;';
		$supermarket_ecommerce_custom_style .=' }';
	}

	$utsav_event_planner_slider_hide_show = get_theme_mod('utsav_event_planner_slider_hide_show',false);
	if( $utsav_event_planner_slider_hide_show == true){
		$utsav_event_planner_custom_style .=' .page-template-custom-home-page #inner-pages-header {';
			$utsav_event_planner_custom_style .=' display:none;';
		$utsav_event_planner_custom_style .=' }';
	}