<?php
/**
 * Custom header implementation
 */

function supermarket_ecommerce_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'supermarket_ecommerce_custom_header_args', array(

		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'supermarket_ecommerce_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'supermarket_ecommerce_custom_header_setup' );

if ( ! function_exists( 'supermarket_ecommerce_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see supermarket_ecommerce_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'supermarket_ecommerce_header_style' );
function supermarket_ecommerce_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        .search-bar{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'supermarket-ecommerce-basic-style', $custom_css );
	endif;
}
endif; // supermarket_ecommerce_header_style