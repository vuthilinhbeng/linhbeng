<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rara_Academic
 */

 /**
     * Doctype Hook
     * 
     * @hooked rara_academic_doctype_cb
    */
    do_action( 'rara_academic_doctype' );
?>

<head itemscope itemtype="https://schema.org/WebSite">

<?php 
    /**
     * Before wp_head
     * 
     * @hooked rara_academic_head
    */
    do_action( 'rara_academic_before_wp_head' );

    wp_head(); 
?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
		
    <?php
    wp_body_open();
    
    /**
    * @hooked rara_academic_page_start 
    */
    do_action( 'rara_academic_before_page_start' );
    
    /**
    * rara_academic Header Top
    * 
    * @hooked rara_academic_header_start  - 10
    * @hooked rara_academic_header_top    - 20
    * @hooked rara_academic_header_bottom - 30
    * @hooked rara_academic_header_end    - 40    
    */
    do_action( 'rara_academic_header' );
    
    /**
    * After Header
    * 
    * @hooked rara_academic_header - 10
    */
    do_action( 'rara_academic_page_header' );