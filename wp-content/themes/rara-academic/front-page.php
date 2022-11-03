<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rara Academic 
 */

$rara_academic_page_sections = array( 'banner', 'courses', 'welcome', 'service', 'notice', 'blog', 'testimonial', 'cta' );
$ed_section                  = rara_academic_home_section();
 
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
}elseif( $ed_section ){ 
    get_header();
    foreach( $rara_academic_page_sections as $section ){ 
        if( get_theme_mod( 'rara_academic_ed_' . $section . '_section' ) == 1 ){
            get_template_part( 'sections/' . esc_attr( $section ) );
        } 
    }
    get_footer();
}else{ 
    include( get_page_template() ); 
}