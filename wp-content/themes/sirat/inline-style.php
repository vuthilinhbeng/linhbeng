<?php

	$sirat_first_color = get_theme_mod('sirat_first_color');
	$sirat_custom_css = '';

	/*------------------- Global First Color -----------------*/

	if($sirat_first_color != false){
		$sirat_custom_css .='.top-bar, input[type="submit"],.top-btn a,.more-btn a,#sidebar h3,#footer-2,.pagination .current,.pagination a:hover, #comments input[type="submit"],#sidebar .custom-social-icons i, #footer .custom-social-icons i,#sidebar .tagcloud a:hover,.serv-box:hover,.box .inner-content:after, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover,#header main-menu-navigation ul.sub-menu li a:hover,#footer .tagcloud a:hover,nav.woocommerce-MyAccount-navigation ul li,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .main-menu-navigation .current_page_item > a, .main-menu-navigation .current-menu-item > a, .main-menu-navigation .current_page_ancestor > a, #footer input[type="submit"]:hover, #comments a.comment-reply-link, #comments input[type="submit"].submit, #sidebar .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_price_filter .ui-slider .ui-slider-handle, #sidebar .woocommerce-product-search button, #footer .widget_price_filter .ui-slider .ui-slider-range, #footer .widget_price_filter .ui-slider .ui-slider-handle, #footer .woocommerce-product-search button, .nav-previous a:hover, .nav-next a:hover, #footer a.custom_read_more, #sidebar a.custom_read_more, .toggle-nav button, #slider .carousel-indicators .active, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .single-post .bradcrumbs span, .single-post .bradcrumbs a:hover, .middle-align .bradcrumbs a:hover, .middle-align .bradcrumbs span, .wp-block-button__link, a.scrollup:hover, #preloader, #footer button.wp-block-search__button, #sidebar label.wp-block-search__label, #sidebar button.wp-block-search__button{';
			$sirat_custom_css .='background-color: '.esc_attr($sirat_first_color).';';
		$sirat_custom_css .='}';
	}
	if($sirat_first_color != false){
		$sirat_custom_css .='.scrollup, #slider .carousel-control-prev-icon:hover, #slider .carousel-control-next-icon:hover, #comments input[type="submit"].submit{';
			$sirat_custom_css .='border-color: '.esc_attr($sirat_first_color).';';
		$sirat_custom_css .='}';
	}
	if($sirat_first_color != false){
		$sirat_custom_css .='a, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title,#header main-menu-navigation ul li a:hover,.post-main-box:hover h3,.scrollup,#footer h3,.serv-box a,#footer li a:hover,a.scrollup, #footer .custom-social-icons i:hover, #sidebar ul li a:hover, .main-menu-navigation a:hover, .main-menu-navigation ul.sub-menu a:hover, .post-main-box:hover h2 a, .post-main-box:hover .entry-date a, .post-main-box:hover .entry-author a, .single-post .post-info:hover a, .post-main-box h1 a:hover, .post-main-box h2 a:hover, #footer a.custom_read_more:hover, .main-menu-navigation ul ul a:hover, .logo .site-title a:hover, #slider .inner_carousel h1 a:hover, #slider .slider-inner-content h1 a:hover, #footer label.wp-block-search__label{';
			$sirat_custom_css .='color: '.esc_attr($sirat_first_color).';';
		$sirat_custom_css .='}';
	}
	if($sirat_first_color != false){
		$sirat_custom_css .='.main-menu-navigation ul ul a:hover{';
			$sirat_custom_css .='color: '.esc_attr($sirat_first_color).'!important;';
		$sirat_custom_css .='}';
	}
	if($sirat_first_color != false){
		$sirat_custom_css .='.main-menu-navigation ul ul{';
			$sirat_custom_css .='border-top-color: '.esc_attr($sirat_first_color).';';
		$sirat_custom_css .='}';
	}
	if($sirat_first_color != false){
		$sirat_custom_css .='#footer h3:after,#slider,.middle-header, .main-menu-navigation ul ul, #footer label.wp-block-search__label:after{';
			$sirat_custom_css .='border-bottom-color: '.esc_attr($sirat_first_color).';';
		$sirat_custom_css .='}';
	}
	if($sirat_first_color != false){
		$sirat_custom_css .='#slider .inner_carousel, .heading-box h2{';
			$sirat_custom_css .='border-left-color: '.esc_attr($sirat_first_color).';';
		$sirat_custom_css .='}';
	}
	if($sirat_first_color != false){
		$sirat_custom_css .='.main-menu-navigation ul ul{
		box-shadow: 0 0px 3px '.esc_attr($sirat_first_color).';
		}';
	}
	/*---------------------- Width Layout -------------------*/

	$sirat_theme_lay = get_theme_mod( 'sirat_width_option','Full Width');
    if($sirat_theme_lay == 'Boxed'){
		$sirat_custom_css .='body{';
			$sirat_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto !important; margin-left: auto !important;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.scrollup{';
			$sirat_custom_css .='right: 100px;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.scrollup.left{';
			$sirat_custom_css .='left: 100px;';
		$sirat_custom_css .='}';
	}else if($sirat_theme_lay == 'Wide Width'){
		$sirat_custom_css .='body{';
			$sirat_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.scrollup{';
			$sirat_custom_css .='right: 30px;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.scrollup.left{';
			$sirat_custom_css .='left: 30px;';
		$sirat_custom_css .='}';
	}else if($sirat_theme_lay == 'Full Width'){
		$sirat_custom_css .='body{';
			$sirat_custom_css .='max-width: 100%;';
		$sirat_custom_css .='}';
	}

	/*--------------------- Slider Opacity -------------------*/

	$sirat_theme_lay = get_theme_mod( 'sirat_slider_opacity_color','0.5');
	if($sirat_theme_lay == '0'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0';
		$sirat_custom_css .='}';
		}else if($sirat_theme_lay == '0.1'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0.1';
		$sirat_custom_css .='}';
		}else if($sirat_theme_lay == '0.2'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0.2';
		$sirat_custom_css .='}';
		}else if($sirat_theme_lay == '0.3'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0.3';
		$sirat_custom_css .='}';
		}else if($sirat_theme_lay == '0.4'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0.4';
		$sirat_custom_css .='}';
		}else if($sirat_theme_lay == '0.5'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0.5';
		$sirat_custom_css .='}';
		}else if($sirat_theme_lay == '0.6'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0.6';
		$sirat_custom_css .='}';
		}else if($sirat_theme_lay == '0.7'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0.7';
		$sirat_custom_css .='}';
		}else if($sirat_theme_lay == '0.8'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0.8';
		$sirat_custom_css .='}';
		}else if($sirat_theme_lay == '0.9'){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:0.9';
		$sirat_custom_css .='}';
		}

	/*------------------ Slider Content Layout ---------------*/

	$sirat_theme_lay = get_theme_mod( 'sirat_slider_content_option','Left');
    if($sirat_theme_lay == 'Left'){
		$sirat_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$sirat_custom_css .='text-align:left; left:15%; right:45%;';
		$sirat_custom_css .='}';
	}else if($sirat_theme_lay == 'Center'){
		$sirat_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$sirat_custom_css .='text-align:center; left:20%; right:20%;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='#slider .inner_carousel{';
			$sirat_custom_css .='border-left:none;';
		$sirat_custom_css .='}';
	}else if($sirat_theme_lay == 'Right'){
		$sirat_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$sirat_custom_css .='text-align:right; left:45%; right:15%;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='#slider .inner_carousel{';
			$sirat_custom_css .='border-right:solid 4px #febe00; border-left:none; padding-right: 20px;';
		$sirat_custom_css .='}';
	}

	/*--------------- Slider Gradient Background ------------*/

	$sirat_slider_bg = get_theme_mod( 'sirat_slider_background','#febe00');
	if($sirat_slider_bg != false){
		$sirat_custom_css .='.slider-page-image{
		background-color: '.esc_attr($sirat_slider_bg).';
		}';
	}

	/*----------------------- Header Layout -------------------*/

	$sirat_theme_lay = get_theme_mod( 'sirat_header_content_option','Left');
    if($sirat_theme_lay == 'Left'){
		$sirat_custom_css .='#header main-menu-navigation ul{';
			$sirat_custom_css .='text-align:right;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.logo{';
			$sirat_custom_css .='border-bottom:none;';
		$sirat_custom_css .='}';
	}else if($sirat_theme_lay == 'Center'){
		$sirat_custom_css .='#header main-menu-navigation ul{';
			$sirat_custom_css .='text-align:center;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.logo{';
			$sirat_custom_css .='padding:15px 0; text-align:center;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.middle-header{';
			$sirat_custom_css .='padding: 0;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.toggle-nav, #mySidenav{';
			$sirat_custom_css .='text-align: center;';
		$sirat_custom_css .='}';
	}else if($sirat_theme_lay == 'Right'){
		$sirat_custom_css .='#header main-menu-navigation ul{';
			$sirat_custom_css .='text-align:left;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.logo{';
			$sirat_custom_css .='border-bottom:none;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='#mySidenav, .toggle-nav{';
			$sirat_custom_css .='text-align: right;';
		$sirat_custom_css .='}';

		$sirat_custom_css .='@media screen and (max-width:720px) {';
			$sirat_custom_css .='.toggle-nav{';
				$sirat_custom_css .='text-align: center;';
			$sirat_custom_css .='}';
		$sirat_custom_css .='}';
	}

	/*----------------------- Blog Layout -------------------*/

	$sirat_theme_lay = get_theme_mod( 'sirat_blog_layout_option','Default');
    if($sirat_theme_lay == 'Default'){
		$sirat_custom_css .='.post-main-box{';
			$sirat_custom_css .='';
		$sirat_custom_css .='}';
	}else if($sirat_theme_lay == 'Center'){
		$sirat_custom_css .='.post-main-box, .post-main-box h2, .new-text p{';
			$sirat_custom_css .='text-align:center;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.post-info{';
			$sirat_custom_css .='margin-top: 10px;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.sticky .post-main-box h2{';
			$sirat_custom_css .='display: unset;';
		$sirat_custom_css .='}';
	}else if($sirat_theme_lay == 'Left'){
		$sirat_custom_css .='.post-main-box, .post-main-box h2, .new-text p{';
			$sirat_custom_css .='text-align:Left;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.post-info{';
			$sirat_custom_css .='margin-top: 10px;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.post-main-box h2{';
			$sirat_custom_css .='margin-top: 10px;';
		$sirat_custom_css .='}';
	}

	/*--------------------- Blog Page Posts -------------------*/

	$sirat_blog_page_posts_settings = get_theme_mod( 'sirat_blog_page_posts_settings','Into Blocks');
    if($sirat_blog_page_posts_settings == 'Without Blocks'){
		$sirat_custom_css .='.post-main-box{';
			$sirat_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$sirat_custom_css .='}';
	}

	/*-------------------- Top Bar Settings ------------------*/

	$sirat_topbar_padding_top_bottom = get_theme_mod('sirat_topbar_padding_top_bottom');
	if($sirat_topbar_padding_top_bottom != false){
		$sirat_custom_css .='.top-bar{';
			$sirat_custom_css .='padding-top: '.esc_attr($sirat_topbar_padding_top_bottom).'; padding-bottom: '.esc_attr($sirat_topbar_padding_top_bottom).';';
		$sirat_custom_css .='}';
	}

	/*----------------------- Slider Height -------------------*/

	$sirat_slider_height = get_theme_mod('sirat_slider_height');
	if($sirat_slider_height != false){
		$sirat_custom_css .='#slider img, #slider .slider-image img, #slider .slider-page-image{';
			$sirat_custom_css .='height: '.esc_attr($sirat_slider_height).';';
		$sirat_custom_css .='}';
	}

	/*------------- Slider Content Padding Settings ------------------*/

	$sirat_slider_content_padding_top_bottom = get_theme_mod('sirat_slider_content_padding_top_bottom');
	$sirat_slider_content_padding_left_right = get_theme_mod('sirat_slider_content_padding_left_right');
	if($sirat_slider_content_padding_top_bottom != false || $sirat_slider_content_padding_left_right != false){
		$sirat_custom_css .='#slider .carousel-caption{';
			$sirat_custom_css .='top: '.esc_attr($sirat_slider_content_padding_top_bottom).'; bottom: '.esc_attr($sirat_slider_content_padding_top_bottom).';left: '.esc_attr($sirat_slider_content_padding_left_right).';right: '.esc_attr($sirat_slider_content_padding_left_right).';';
		$sirat_custom_css .='}';
	}

	/*---------------------- Slider ------------------------*/

	$sirat_slider_layout = get_theme_mod( 'sirat_slider_arrows',false);
	if($sirat_slider_layout == true){
		$sirat_custom_css .='.customize-partial-edit-shortcuts-shown .slider-refresh{';
			$sirat_custom_css .='display: none;';
		$sirat_custom_css .='}';
	}

	/*---------------------- Slider Image Overlay ------------------------*/

	$sirat_slider_image_overlay = get_theme_mod('sirat_slider_image_overlay', true);
	if($sirat_slider_image_overlay == false){
		$sirat_custom_css .='#slider img{';
			$sirat_custom_css .='opacity:1;';
		$sirat_custom_css .='}';
	} 
	
	$sirat_slider_image_overlay_color = get_theme_mod('sirat_slider_image_overlay_color', true);
	if($sirat_slider_image_overlay_color != false){
		$sirat_custom_css .='#slider{';
			$sirat_custom_css .='background-color: '.esc_attr($sirat_slider_image_overlay_color).';';
		$sirat_custom_css .='}';
	}

	/*------------------- Services Section --------------------*/
	
	$sirat_services_title = get_theme_mod( 'sirat_section_title','');
	if( $sirat_services_title == true  ){
		$sirat_custom_css .='.customize-partial-edit-shortcuts-shown .services-refresh{';
			$sirat_custom_css .='display: none;';
		$sirat_custom_css .='}';
	}

	/*------------------ Search Settings -----------------*/
	
	$sirat_search_padding_top_bottom = get_theme_mod('sirat_search_padding_top_bottom');
	$sirat_search_padding_left_right = get_theme_mod('sirat_search_padding_left_right');
	$sirat_search_font_size = get_theme_mod('sirat_search_font_size');
	$sirat_search_border_radius = get_theme_mod('sirat_search_border_radius');
	if($sirat_search_padding_top_bottom != false || $sirat_search_padding_left_right != false || $sirat_search_font_size != false || $sirat_search_border_radius != false){
		$sirat_custom_css .='.search-box i{';
			$sirat_custom_css .='padding-top: '.esc_attr($sirat_search_padding_top_bottom).'; padding-bottom: '.esc_attr($sirat_search_padding_top_bottom).';padding-left: '.esc_attr($sirat_search_padding_left_right).';padding-right: '.esc_attr($sirat_search_padding_left_right).';font-size: '.esc_attr($sirat_search_font_size).';border-radius: '.esc_attr($sirat_search_border_radius).'px;';
		$sirat_custom_css .='}';
	}

	/*------------- Navigation Menus Settings ------------------*/

	$sirat_navigation_menu_font_size = get_theme_mod('sirat_navigation_menu_font_size');
	if($sirat_navigation_menu_font_size != false){
		$sirat_custom_css .='.main-menu-navigation a{';
			$sirat_custom_css .='font-size: '.esc_attr($sirat_navigation_menu_font_size).';';
		$sirat_custom_css .='}';
	}

	$sirat_nav_menus_font_weight = get_theme_mod( 'sirat_navigation_menu_font_weight','Default');
    if($sirat_nav_menus_font_weight == 'Default'){
		$sirat_custom_css .='.main-menu-navigation a{';
			$sirat_custom_css .='';
		$sirat_custom_css .='}';
	}else if($sirat_nav_menus_font_weight == 'Normal'){
		$sirat_custom_css .='.main-menu-navigation a{';
			$sirat_custom_css .='font-weight: normal;';
		$sirat_custom_css .='}';
	}

	$sirat_menu_text = get_theme_mod( 'sirat_navigation_menu_text_transform','Default');
	if($sirat_menu_text == 'Default'){
		$sirat_custom_css .='.main-menu-navigation a{';
			$sirat_custom_css .='';
		$sirat_custom_css .='}';
	}else if($sirat_menu_text == 'Uppercase'){
		$sirat_custom_css .='.main-menu-navigation a{';
				$sirat_custom_css .='text-transform:uppercase;';
			$sirat_custom_css .='}';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$sirat_sticky_header_padding = get_theme_mod('sirat_sticky_header_padding');
	if($sirat_sticky_header_padding != false){
		$sirat_custom_css .='.header-fixed{';
			$sirat_custom_css .='padding: '.esc_attr($sirat_sticky_header_padding).'!important;';
		$sirat_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$sirat_button_padding_top_bottom = get_theme_mod('sirat_button_padding_top_bottom');
	$sirat_button_padding_left_right = get_theme_mod('sirat_button_padding_left_right');
	if($sirat_button_padding_top_bottom != false || $sirat_button_padding_left_right != false){
		$sirat_custom_css .='.post-main-box .more-btn a{';
			$sirat_custom_css .='padding-top: '.esc_attr($sirat_button_padding_top_bottom).'; padding-bottom: '.esc_attr($sirat_button_padding_top_bottom).';padding-left: '.esc_attr($sirat_button_padding_left_right).';padding-right: '.esc_attr($sirat_button_padding_left_right).';';
		$sirat_custom_css .='}';
	}

	$sirat_button_border_radius = get_theme_mod('sirat_button_border_radius');
	if($sirat_button_border_radius != false){
		$sirat_custom_css .='.post-main-box more-btn a{';
			$sirat_custom_css .='border-radius: '.esc_attr($sirat_button_border_radius).'px;';
		$sirat_custom_css .='}';
	}

	/*------------- Single Blog Page------------------*/

	$sirat_single_blog_post_navigation_show_hide = get_theme_mod('sirat_single_blog_post_navigation_show_hide',true);
	if($sirat_single_blog_post_navigation_show_hide != true){
		$sirat_custom_css .='.post-navigation{';
			$sirat_custom_css .='display: none;';
		$sirat_custom_css .='}';
	}

	// comment settings
	$sirat_single_blog_comment_show_hide = get_theme_mod('sirat_single_blog_comment_show_hide',true);
	if($sirat_single_blog_comment_show_hide != true){
		$sirat_custom_css .='#comments{';
			$sirat_custom_css .='display: none;';
		$sirat_custom_css .='}';
	}

	$sirat_single_blog_comment_title = get_theme_mod('sirat_single_blog_comment_title', 'Leave a Reply');
	if($sirat_single_blog_comment_title == ''){
		$sirat_custom_css .='#comments h2#reply-title {';
			$sirat_custom_css .='display: none;';
		$sirat_custom_css .='}';
	}

	$sirat_single_blog_comment_button_text = get_theme_mod('sirat_single_blog_comment_button_text', 'Post Comment');
	if($sirat_single_blog_comment_button_text == ''){
		$sirat_custom_css .='#comments p.form-submit {';
			$sirat_custom_css .='display: none;';
		$sirat_custom_css .='}';
	}

	$sirat_comment_width = get_theme_mod('sirat_single_blog_comment_width');
	if($sirat_comment_width != false){
		$sirat_custom_css .='#comments textarea{';
			$sirat_custom_css .='width: '.esc_attr($sirat_comment_width).';';
		$sirat_custom_css .='}';
	}

	$sirat_featured_img_border_radius = get_theme_mod('sirat_featured_image_border_radius');
	if($sirat_featured_img_border_radius != false){
		$sirat_custom_css .='.box-image img, .feature-box img, #content-vw img{';
			$sirat_custom_css .='border-radius: '.esc_attr($sirat_featured_img_border_radius).'px;';
		$sirat_custom_css .='}';
	}

	$sirat_featured_img_box_shadow = get_theme_mod('sirat_featured_image_box_shadow',0);
	if($sirat_featured_img_box_shadow != false){
		$sirat_custom_css .='.box-image img, .feature-box img, #content-vw img{';
			$sirat_custom_css .='box-shadow: '.esc_attr($sirat_featured_img_box_shadow).'px '.esc_attr($sirat_featured_img_box_shadow).'px '.esc_attr($sirat_featured_img_box_shadow).'px #cccccc;';
		$sirat_custom_css .='}';
	}

	/*-------------------------- Responsive Media ---------------------*/

	$sirat_resp_topbar = get_theme_mod( 'sirat_resp_topbar_hide_show',false);
	if($sirat_resp_topbar == true && get_theme_mod( 'sirat_topbar_hide_show', false) == false){
    	$sirat_custom_css .='.top-bar{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} ';
	}
    if($sirat_resp_topbar == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='.top-bar{';
			$sirat_custom_css .='display:block;';
		$sirat_custom_css .='} }';
	}else if($sirat_resp_topbar == false){
		$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='.top-bar{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} }';
	}

	$sirat_resp_search = get_theme_mod( 'sirat_resp_search_hide_show',true);
	if($sirat_resp_search == true && get_theme_mod( 'sirat_header_search',true) != true){
    	$sirat_custom_css .='.search-box{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} ';
	}
    if($sirat_resp_search == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='.search-box{';
			$sirat_custom_css .='display:block;';
		$sirat_custom_css .='} }';
	}else if($sirat_resp_search == false){
		$sirat_custom_css .='@media screen and (max-width:575px){';
		$sirat_custom_css .='.search-box{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} }';
	}

	$sirat_resp_stickyheader = get_theme_mod( 'sirat_stickyheader_hide_show',false);
	if($sirat_resp_stickyheader == true && get_theme_mod( 'sirat_sticky_header',false) != true){
    	$sirat_custom_css .='.header-fixed{';
			$sirat_custom_css .='position:static;';
		$sirat_custom_css .='} ';
	}
    if($sirat_resp_stickyheader == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='.header-fixed{';
			$sirat_custom_css .='position:fixed;';
		$sirat_custom_css .='} }';
	}else if($sirat_resp_stickyheader == false){
		$sirat_custom_css .='@media screen and (max-width:575px){';
		$sirat_custom_css .='.header-fixed{';
			$sirat_custom_css .='position:static;';
		$sirat_custom_css .='} }';
	}

	$sirat_resp_slider = get_theme_mod( 'sirat_resp_slider_hide_show',false);
	if($sirat_resp_slider == true && get_theme_mod( 'sirat_slider_arrows', false) == false){
    	$sirat_custom_css .='#slider{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} ';
	}
    if($sirat_resp_slider == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='#slider{';
			$sirat_custom_css .='display:block;';
		$sirat_custom_css .='} }';
	}else if($sirat_resp_slider == false){
		$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='#slider{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} }';
	}

	$sirat_resp_slider_button = get_theme_mod( 'sirat_resp_slider_btn_hide_show',false);
	if($sirat_resp_slider_button == true && get_theme_mod( 'sirat_slider_button_hide_show', false) == false){
    	$sirat_custom_css .='#slider .more-btn, #slider .slider-inner-content .more-btn{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} ';
	}
    if($sirat_resp_slider_button == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='#slider .more-btn, #slider .slider-inner-content .more-btn{';
			$sirat_custom_css .='display:block;';
		$sirat_custom_css .='} }';
	}else if($sirat_resp_slider_button == false){
		$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='#slider .more-btn, #slider .slider-inner-content .more-btn{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} }';
	}

	$sirat_toggle_postdate = get_theme_mod( 'sirat_toggle_postdate_hide_show',true);
	if($sirat_toggle_postdate == true && get_theme_mod( 'sirat_toggle_postdate',true) != true){
    	$sirat_custom_css .='span.entry-date{';
			$sirat_custom_css .='display:none !important;';
		$sirat_custom_css .='} ';
	}
    if($sirat_toggle_postdate == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='span.entry-date{';
			$sirat_custom_css .='display:inline-block !important;';
		$sirat_custom_css .='} }';
	}else if($sirat_toggle_postdate == false){
		$sirat_custom_css .='@media screen and (max-width:575px){';
		$sirat_custom_css .='span.entry-date{';
			$sirat_custom_css .='display:none !important;';
		$sirat_custom_css .='} }';
	}

	$sirat_toggle_author = get_theme_mod( 'sirat_toggle_author_hide_show',true);
	if($sirat_toggle_author == true && get_theme_mod( 'sirat_toggle_author',true) != true){
    	$sirat_custom_css .='span.entry-author{';
			$sirat_custom_css .='display:none !important;';
		$sirat_custom_css .='} ';
	}
    if($sirat_toggle_author == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='span.entry-author{';
			$sirat_custom_css .='display:inline-block !important;';
		$sirat_custom_css .='} }';
	}else if($sirat_toggle_author == false){
		$sirat_custom_css .='@media screen and (max-width:575px){';
		$sirat_custom_css .='span.entry-author{';
			$sirat_custom_css .='display:none !important;';
		$sirat_custom_css .='} }';
	}

	$sirat_toggle_comments = get_theme_mod( 'sirat_toggle_comments_hide_show',true);
	if($sirat_toggle_comments == true && get_theme_mod( 'sirat_toggle_comments',true) != true){
    	$sirat_custom_css .='span.entry-comments{';
			$sirat_custom_css .='display:none !important;';
		$sirat_custom_css .='} ';
	}
    if($sirat_toggle_comments == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='span.entry-comments{';
			$sirat_custom_css .='display:inline-block !important;';
		$sirat_custom_css .='} }';
	}else if($sirat_toggle_comments == false){
		$sirat_custom_css .='@media screen and (max-width:575px){';
		$sirat_custom_css .='span.entry-comments{';
			$sirat_custom_css .='display:none !important;';
		$sirat_custom_css .='} }';
	}

	$sirat_toggle_time = get_theme_mod( 'sirat_toggle_time_hide_show',true);
	if($sirat_toggle_time == true && get_theme_mod( 'sirat_toggle_time',true) != true){
    	$sirat_custom_css .='span.entry-time{';
			$sirat_custom_css .='display:none !important;';
		$sirat_custom_css .='} ';
	}
    if($sirat_toggle_time == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='span.entry-time{';
			$sirat_custom_css .='display:inline-block !important;';
		$sirat_custom_css .='} }';
	}else if($sirat_toggle_time == false){
		$sirat_custom_css .='@media screen and (max-width:575px){';
		$sirat_custom_css .='span.entry-time{';
			$sirat_custom_css .='display:none !important;';
		$sirat_custom_css .='} }';
	}

	$sirat_metabox = get_theme_mod( 'sirat_metabox_hide_show',true);
    if($sirat_metabox == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='.post-info{';
			$sirat_custom_css .='display:block;';
		$sirat_custom_css .='} }';
	}else if($sirat_metabox == false){
		$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='.post-info{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} }';
	}

	$sirat_resp_scroll_top = get_theme_mod( 'sirat_resp_scroll_top_hide_show',true);
	if($sirat_resp_scroll_top == true && get_theme_mod( 'sirat_hide_show_scroll',true) != true){
    	$sirat_custom_css .='a.scrollup{';
			$sirat_custom_css .='visibility:hidden !important;';
		$sirat_custom_css .='} ';
	}
    if($sirat_resp_scroll_top == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='a.scrollup{';
			$sirat_custom_css .='visibility:visible !important;';
		$sirat_custom_css .='} }';
	}else if($sirat_resp_scroll_top == false){
		$sirat_custom_css .='@media screen and (max-width:575px){';
		$sirat_custom_css .='a.scrollup{';
			$sirat_custom_css .='visibility:hidden !important;';
		$sirat_custom_css .='} }';
	}

	$sirat_resp_sidebar = get_theme_mod( 'sirat_resp_sidebar_hide_show',true);
    if($sirat_resp_sidebar == true){
    	$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='#sidebar{';
			$sirat_custom_css .='display:block;';
		$sirat_custom_css .='} }';
	}else if($sirat_resp_sidebar == false){
		$sirat_custom_css .='@media screen and (max-width:575px) {';
		$sirat_custom_css .='#sidebar{';
			$sirat_custom_css .='display:none;';
		$sirat_custom_css .='} }';
	}

	$sirat_resp_menu_toggle_btn_bg_color = get_theme_mod('sirat_resp_menu_toggle_btn_bg_color');
	if($sirat_resp_menu_toggle_btn_bg_color != false){
		$sirat_custom_css .='.toggle-nav button{';
			$sirat_custom_css .='background: '.esc_attr($sirat_resp_menu_toggle_btn_bg_color).';';
		$sirat_custom_css .='}';
	}

	/*------------------- Woocommerce Products -------------------*/

	// Woocommerce Shop page pagination
	$sirat_woocommerce_shop_page_pagination = get_theme_mod('sirat_woocommerce_shop_page_pagination',true);
	if ($sirat_woocommerce_shop_page_pagination == false) {
		$sirat_custom_css .='.woocommerce nav.woocommerce-pagination{';
			$sirat_custom_css .='display: none;';
		$sirat_custom_css .='}';
	}

	$sirat_related_product_show_hide = get_theme_mod('sirat_related_product_show_hide',true);
	if($sirat_related_product_show_hide != true){
		$sirat_custom_css .='.related.products{';
			$sirat_custom_css .='display: none;';
		$sirat_custom_css .='}';
	}

	$sirat_products_border = get_theme_mod( 'sirat_products_border', false); 
	if($sirat_products_border == true){ 
		$sirat_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{'; 
			$sirat_custom_css .='border: 1px solid #ddd;'; 
		$sirat_custom_css .='}'; 
	}

	$sirat_products_padding_top_bottom = get_theme_mod('sirat_products_padding_top_bottom');
	if($sirat_products_padding_top_bottom != false){
		$sirat_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$sirat_custom_css .='padding-top: '.esc_attr($sirat_products_padding_top_bottom).'!important; padding-bottom: '.esc_attr($sirat_products_padding_top_bottom).'!important;';
		$sirat_custom_css .='}';
	}

	$sirat_products_padding_left_right = get_theme_mod('sirat_products_padding_left_right');
	if($sirat_products_padding_left_right != false){
		$sirat_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$sirat_custom_css .='padding-left: '.esc_attr($sirat_products_padding_left_right).'!important; padding-right: '.esc_attr($sirat_products_padding_left_right).'!important;';
		$sirat_custom_css .='}';
	}

	$sirat_products_box_shadow = get_theme_mod('sirat_products_box_shadow');
	if($sirat_products_box_shadow != false){
		$sirat_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$sirat_custom_css .='box-shadow: '.esc_attr($sirat_products_box_shadow).'px '.esc_attr($sirat_products_box_shadow).'px '.esc_attr($sirat_products_box_shadow).'px #ddd;';
		$sirat_custom_css .='}';
	}

	$sirat_products_border_radius = get_theme_mod('sirat_products_border_radius');
	if($sirat_products_border_radius != false){
		$sirat_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$sirat_custom_css .='border-radius: '.esc_attr($sirat_products_border_radius).'px;';
		$sirat_custom_css .='}';
	}

	$sirat_products_btn_padding_top_bottom = get_theme_mod('sirat_products_btn_padding_top_bottom');
	if($sirat_products_btn_padding_top_bottom != false){
		$sirat_custom_css .='.woocommerce a.button{';
			$sirat_custom_css .='padding-top: '.esc_attr($sirat_products_btn_padding_top_bottom).'; padding-bottom: '.esc_attr($sirat_products_btn_padding_top_bottom).';';
		$sirat_custom_css .='}';
	}

	$sirat_products_btn_padding_left_right = get_theme_mod('sirat_products_btn_padding_left_right');
	if($sirat_products_btn_padding_left_right != false){
		$sirat_custom_css .='.woocommerce a.button{';
			$sirat_custom_css .='padding-left: '.esc_attr($sirat_products_btn_padding_left_right).'; padding-right: '.esc_attr($sirat_products_btn_padding_left_right).';';
		$sirat_custom_css .='}';
	}

	$sirat_products_button_border_radius = get_theme_mod('sirat_products_button_border_radius');
	if($sirat_products_button_border_radius != false){
		$sirat_custom_css .='.woocommerce ul.products li.product .button, a.checkout-button.button.alt.wc-forward,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
			$sirat_custom_css .='border-radius: '.esc_attr($sirat_products_button_border_radius).'px;';
		$sirat_custom_css .='}';
	}

	/*--------------------- Sale Settings  ------------------------*/

	$sirat_woocommerce_sale_position = get_theme_mod( 'sirat_woocommerce_sale_position','right');
    if($sirat_woocommerce_sale_position == 'left'){
		$sirat_custom_css .='.woocommerce ul.products li.product .onsale{';
			$sirat_custom_css .='left: -10px; right: auto;';
		$sirat_custom_css .='}';
	}else if($sirat_woocommerce_sale_position == 'right'){
		$sirat_custom_css .='.woocommerce ul.products li.product .onsale{';
			$sirat_custom_css .='left: auto; right: 0;';
		$sirat_custom_css .='}';
	}

	$sirat_woocommerce_sale_font_size = get_theme_mod('sirat_woocommerce_sale_font_size');
	if($sirat_woocommerce_sale_font_size != false){
		$sirat_custom_css .='.woocommerce span.onsale{';
			$sirat_custom_css .='font-size: '.esc_attr($sirat_woocommerce_sale_font_size).';';
		$sirat_custom_css .='}';
	}

	$sirat_woocommerce_sale_padding_top_bottom = get_theme_mod('sirat_woocommerce_sale_padding_top_bottom');
	if($sirat_woocommerce_sale_padding_top_bottom != false){
		$sirat_custom_css .='.woocommerce span.onsale{';
			$sirat_custom_css .='padding-top: '.esc_attr($sirat_woocommerce_sale_padding_top_bottom).'; padding-bottom: '.esc_attr($sirat_woocommerce_sale_padding_top_bottom).';';
		$sirat_custom_css .='}';
	}

	$sirat_woocommerce_sale_padding_left_right = get_theme_mod('sirat_woocommerce_sale_padding_left_right');
	if($sirat_woocommerce_sale_padding_left_right != false){
		$sirat_custom_css .='.woocommerce span.onsale{';
			$sirat_custom_css .='padding-left: '.esc_attr($sirat_woocommerce_sale_padding_left_right).'; padding-right: '.esc_attr($sirat_woocommerce_sale_padding_left_right).';';
		$sirat_custom_css .='}';
	}

	$sirat_woocommerce_sale_border_radius = get_theme_mod('sirat_woocommerce_sale_border_radius');
	if($sirat_woocommerce_sale_border_radius != false){
		$sirat_custom_css .='.woocommerce span.onsale{';
			$sirat_custom_css .='border-radius: '.esc_attr($sirat_woocommerce_sale_border_radius).'px;';
		$sirat_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$sirat_copyright_font_size = get_theme_mod('sirat_copyright_font_size');
	if($sirat_copyright_font_size != false){
		$sirat_custom_css .='.copyright p{';
			$sirat_custom_css .='font-size: '.esc_attr($sirat_copyright_font_size).';';
		$sirat_custom_css .='}';
	}

	$sirat_copyright_padding_top_bottom = get_theme_mod('sirat_copyright_padding_top_bottom');
	if($sirat_copyright_padding_top_bottom != false){
		$sirat_custom_css .='#footer-2{';
			$sirat_custom_css .='padding-top: '.esc_attr($sirat_copyright_padding_top_bottom).'; padding-bottom: '.esc_attr($sirat_copyright_padding_top_bottom).';';
		$sirat_custom_css .='}';
	}

	$sirat_copyright_alingment = get_theme_mod('sirat_copyright_alingment');
	if($sirat_copyright_alingment != false){
		$sirat_custom_css .='.copyright p{';
			$sirat_custom_css .='text-align: '.esc_attr($sirat_copyright_alingment).';';
		$sirat_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$sirat_social_icon_font_size = get_theme_mod('sirat_social_icon_font_size');
	if($sirat_social_icon_font_size != false){
		$sirat_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$sirat_custom_css .='font-size: '.esc_attr($sirat_social_icon_font_size).';';
		$sirat_custom_css .='}';
	}

	$sirat_social_icon_padding = get_theme_mod('sirat_social_icon_padding');
	if($sirat_social_icon_padding != false){
		$sirat_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$sirat_custom_css .='padding: '.esc_attr($sirat_social_icon_padding).';';
		$sirat_custom_css .='}';
	}

	$sirat_social_icon_width = get_theme_mod('sirat_social_icon_width');
	if($sirat_social_icon_width != false){
		$sirat_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$sirat_custom_css .='width: '.esc_attr($sirat_social_icon_width).';';
		$sirat_custom_css .='}';
	}

	$sirat_social_icon_height = get_theme_mod('sirat_social_icon_height');
	if($sirat_social_icon_height != false){
		$sirat_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$sirat_custom_css .='height: '.esc_attr($sirat_social_icon_height).';';
		$sirat_custom_css .='}';
	}

	$sirat_social_icon_border_radius = get_theme_mod('sirat_social_icon_border_radius');
	if($sirat_social_icon_border_radius != false){
		$sirat_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$sirat_custom_css .='border-radius: '.esc_attr($sirat_social_icon_border_radius).'px;';
		$sirat_custom_css .='}';
	}

	/*------------- Footer Background Color ------------------*/

	$sirat_footer_background_color = get_theme_mod('sirat_footer_background_color');
	if($sirat_footer_background_color != false){
		$sirat_custom_css .='#footer{';
			$sirat_custom_css .='background-color: '.esc_attr($sirat_footer_background_color).';';
		$sirat_custom_css .='}';
	}

	$sirat_footer_background_image = get_theme_mod('sirat_footer_background_image');
	if($sirat_footer_background_image != false){
		$sirat_custom_css .='#footer{';
			$sirat_custom_css .='background: url('.esc_attr($sirat_footer_background_image).');';
		$sirat_custom_css .='}';
	}

	$sirat_footer_widgets_heading = get_theme_mod( 'sirat_footer_widgets_heading','Left');
    if($sirat_footer_widgets_heading == 'Left'){
		$sirat_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
		$sirat_custom_css .='text-align: left;';
		$sirat_custom_css .='}';
	}else if($sirat_footer_widgets_heading == 'Center'){
		$sirat_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
			$sirat_custom_css .='text-align: center;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='#footer h3:after, #footer label.wp-block-search__label:after{';
			$sirat_custom_css .='margin: 0 auto;';
		$sirat_custom_css .='}';
	}else if($sirat_footer_widgets_heading == 'Right'){
		$sirat_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
			$sirat_custom_css .='text-align: right;';
		$sirat_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$sirat_scroll_to_top_font_size = get_theme_mod('sirat_scroll_to_top_font_size');
	if($sirat_scroll_to_top_font_size != false){
		$sirat_custom_css .='.scrollup{';
			$sirat_custom_css .='font-size: '.esc_attr($sirat_scroll_to_top_font_size).';';
		$sirat_custom_css .='}';
	}

	$sirat_scroll_to_top_padding_top_bottom = get_theme_mod('sirat_scroll_to_top_padding_top_bottom');
	if($sirat_scroll_to_top_padding_top_bottom != false){
		$sirat_custom_css .='.scrollup{';
			$sirat_custom_css .='padding-top: '.esc_attr($sirat_scroll_to_top_padding_top_bottom).'; padding-bottom: '.esc_attr($sirat_scroll_to_top_padding_top_bottom).';';
		$sirat_custom_css .='}';
	}

	$sirat_scroll_to_top_width = get_theme_mod('sirat_scroll_to_top_width');
	if($sirat_scroll_to_top_width != false){
		$sirat_custom_css .='.scrollup{';
			$sirat_custom_css .='width: '.esc_attr($sirat_scroll_to_top_width).';';
		$sirat_custom_css .='}';
	}

	$sirat_scroll_to_top_height = get_theme_mod('sirat_scroll_to_top_height');
	if($sirat_scroll_to_top_height != false){
		$sirat_custom_css .='.scrollup{';
			$sirat_custom_css .='height: '.esc_attr($sirat_scroll_to_top_height).';';
		$sirat_custom_css .='}';
	}

	$sirat_scroll_to_top_border_radius = get_theme_mod('sirat_scroll_to_top_border_radius');
	if($sirat_scroll_to_top_border_radius != false){
		$sirat_custom_css .='.scrollup{';
			$sirat_custom_css .='border-radius: '.esc_attr($sirat_scroll_to_top_border_radius).'px;';
		$sirat_custom_css .='}';
	}

	/*------------------ Skin Option  -------------------*/

	$sirat_skin_opt = get_theme_mod( 'sirat_background_skin','Without Background');
    if($sirat_skin_opt == 'With Background'){
		$sirat_custom_css .='.inner-service, .post-main-box, #sidebar .widget, .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .middle-header,.serv-box,.front-page-content,.background-skin-page, .woocommerce .woocommerce-ordering select, #primary{';
			$sirat_custom_css .='background-color: #fff;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.related-post h3{';
			$sirat_custom_css .='padding: 15px 15px 15px;';
		$sirat_custom_css .='}';
		$sirat_custom_css .='.inner-service, #content-vw .background-skin-page, #primary{';
			$sirat_custom_css .='padding: 15px; margin-bottom:10px;';
		$sirat_custom_css .='}';
	}else if($sirat_skin_opt == 'Without Background'){
		$sirat_custom_css .='{';
			$sirat_custom_css .='background-color: transparent;';
		$sirat_custom_css .='}';
	}

	/*------------------ Blog Post Image Color -------------------*/
	
	$sirat_blog_post_featured_image_color = get_theme_mod('sirat_blog_post_featured_image_color', '#26bdf7');
	$sirat_blog_post_featured_image_option = get_theme_mod('sirat_blog_post_featured_image_option','Blog Post Image');
	if($sirat_blog_post_featured_image_option == 'Blog Post Image Color'){
		$sirat_custom_css .='.blog-post-image-color{';
			$sirat_custom_css .='background-color: '.esc_attr($sirat_blog_post_featured_image_color).';';
		$sirat_custom_css .='}';
	}

	// featured image dimention
	$sirat_blog_post_featured_image_dimension = get_theme_mod('sirat_blog_post_featured_image_dimension', 'default');
	$sirat_blog_post_featured_image_custom_width = get_theme_mod('sirat_blog_post_featured_image_custom_width',250);
	$sirat_blog_post_featured_image_custom_height = get_theme_mod('sirat_blog_post_featured_image_custom_height',250);
	if($sirat_blog_post_featured_image_dimension == 'custom'){
		$sirat_custom_css .='.box-image img{';
			$sirat_custom_css .='width: '.esc_attr($sirat_blog_post_featured_image_custom_width).'; height: '.esc_attr($sirat_blog_post_featured_image_custom_height).';';
		$sirat_custom_css .='}';
	}

	/*------------------ Logo Site Title & Tagline  -------------------*/

	$sirat_logo_padding = get_theme_mod('sirat_logo_padding');
	if($sirat_logo_padding != false){
		$sirat_custom_css .='.middle-header .logo{';
			$sirat_custom_css .='padding: '.esc_attr($sirat_logo_padding).';';
		$sirat_custom_css .='}';
	}

	$sirat_logo_margin = get_theme_mod('sirat_logo_margin');
	if($sirat_logo_margin != false){
		$sirat_custom_css .='.middle-header .logo{';
			$sirat_custom_css .='margin: '.esc_attr($sirat_logo_margin).';';
		$sirat_custom_css .='}';
	}

	// Site title Font Size
	$sirat_site_title_font_size = get_theme_mod('sirat_site_title_font_size');
	if($sirat_site_title_font_size != false){
		$sirat_custom_css .='.logo .site-title{';
			$sirat_custom_css .='font-size: '.esc_attr($sirat_site_title_font_size).';';
		$sirat_custom_css .='}';
	}

	// Site title Font Size
	$sirat_site_tagline_font_size = get_theme_mod('sirat_site_tagline_font_size');
	if($sirat_site_tagline_font_size != false){
		$sirat_custom_css .='.logo p.site-description{';
			$sirat_custom_css .='font-size: '.esc_attr($sirat_site_tagline_font_size).';';
		$sirat_custom_css .='}';
	}

	$sirat_header_menus_color = get_theme_mod('sirat_header_menus_color');
	if($sirat_header_menus_color != false){
		$sirat_custom_css .='.main-menu-navigation a, .main-menu-navigation .current_page_item > a, .main-menu-navigation .current-menu-item > a, .main-menu-navigation .current_page_ancestor > a{';
			$sirat_custom_css .='color: '.esc_attr($sirat_header_menus_color).'!important;';
		$sirat_custom_css .='}';
	}

	$sirat_header_menus_hover_color = get_theme_mod('sirat_header_menus_hover_color');
	if($sirat_header_menus_hover_color != false){
		$sirat_custom_css .='.main-menu-navigation a:hover{';
			$sirat_custom_css .='color: '.esc_attr($sirat_header_menus_hover_color).'!important;';
		$sirat_custom_css .='}';
	}

	$sirat_header_submenus_color = get_theme_mod('sirat_header_submenus_color');
	if($sirat_header_submenus_color != false){
		$sirat_custom_css .='.main-menu-navigation ul ul a{';
			$sirat_custom_css .='color: '.esc_attr($sirat_header_submenus_color).'!important;';
		$sirat_custom_css .='}';
	}

	$sirat_header_submenus_hover_color = get_theme_mod('sirat_header_submenus_hover_color');
	if($sirat_header_submenus_hover_color != false){
		$sirat_custom_css .='.main-menu-navigation ul.sub-menu a:hover{';
			$sirat_custom_css .='color: '.esc_attr($sirat_header_submenus_hover_color).'!important;';
		$sirat_custom_css .='}';
	}

	/*------------------ Preloader Background Color  -------------------*/

	$sirat_preloader_bg_color = get_theme_mod('sirat_preloader_bg_color');
	if($sirat_preloader_bg_color != false){
		$sirat_custom_css .='#preloader{';
			$sirat_custom_css .='background-color: '.esc_attr($sirat_preloader_bg_color).';';
		$sirat_custom_css .='}';
	}

	$sirat_preloader_border_color = get_theme_mod('sirat_preloader_border_color');
	if($sirat_preloader_border_color != false){
		$sirat_custom_css .='.loader-line{';
			$sirat_custom_css .='border-color: '.esc_attr($sirat_preloader_border_color).'!important;';
		$sirat_custom_css .='}';
	}

	/*------------------ Mobile Menu Label  -------------------*/

	$sirat_mobile_menu_label = get_theme_mod('sirat_mobile_menu_label',true);
	if($sirat_mobile_menu_label != true){
		$sirat_custom_css .='span.menu-label{';
			$sirat_custom_css .='padding: 0px;';
		$sirat_custom_css .='}';
	}