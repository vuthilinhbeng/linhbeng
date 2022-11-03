<?php
/**
 * @package Sirat
 * Setup the WordPress core custom header feature.
 *
 * @uses sirat_header_style()
*/
function sirat_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'sirat_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 148,
		'flex-width'             => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'sirat_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'sirat_custom_header_setup' );

if ( ! function_exists( 'sirat_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see sirat_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'sirat_header_style' );

function sirat_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        .home-page-header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'sirat-basic-style', $custom_css );
	endif;
}
endif;