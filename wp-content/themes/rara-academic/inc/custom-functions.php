<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Rara_Academic
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rara_academic_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
    if( is_404()){
        $classes[] = 'full-width';
    }

     if( !( is_active_sidebar( 'right-sidebar' ) ) ) {
        $classes[] = 'full-width'; 
    }
    if( rara_academic_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || 'product' === get_post_type() ) && ! is_active_sidebar( 'shop-sidebar' ) ){
        $classes[] = 'full-width';
    }
    
    if( is_page() ){
        $sidebar_layout = rara_academic_sidebar_layout();
        if( $sidebar_layout == 'no-sidebar' )
        $classes[] = 'full-width';
    }

	return $classes;
}
add_filter( 'body_class', 'rara_academic_body_classes' );

/**
 * Return sidebar layouts for pages
*/
function rara_academic_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'rara_academic_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'rara_academic_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}

if( ! function_exists( 'rara_academic_pagination' ) ) :
/**
 * Pagination
*/
function rara_academic_pagination(){
    
    if( is_single() ){
        the_post_navigation();
    }else{
        the_posts_pagination( array(
			'prev_text'   => __( '<<', 'rara-academic' ),
			'next_text'   => __( '>>', 'rara-academic' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'rara-academic' ) . ' </span>',
		 ) );
    }    
}
endif;


if( ! function_exists( 'rara_academic_get_social_links' ) ) :
/**
 * Get Social Links
*/
function rara_academic_get_social_links(){
    $facebook  = get_theme_mod( 'rara_academic_facebook' );
    $twitter   = get_theme_mod( 'rara_academic_twitter' );
    $pinterest = get_theme_mod( 'rara_academic_pinterest' );
    $linkedin  = get_theme_mod( 'rara_academic_linkedin' );
    $gplus     = get_theme_mod( 'rara_academic_gplus' );
    $instagram = get_theme_mod( 'rara_academic_instagram' );
    $youtube   = get_theme_mod( 'rara_academic_youtube' );
    $ok        = get_theme_mod( 'rara_academic_ok' );
    $vk        = get_theme_mod( 'rara_academic_vk' );
    $xing      = get_theme_mod( 'rara_academic_xing' );
    $tiktok    = get_theme_mod( 'rara_academic_tiktok' );
    
    if( $facebook || $twitter || $pinterest || $linkedin || $gplus || $instagram || $youtube || $ok || $vk || $xing || $tiktok ){
    ?>
    <ul class="social-networks">
        <?php if( $facebook ){ ?>
        <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'rara-academic' );?>"><i class="fa fa-facebook"></i></a></li>
        <?php } if( $twitter ){ ?>
        <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'rara-academic' );?>"><i class="fa fa-twitter"></i></a></li>
        <?php } if( $pinterest ){ ?>
        <li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" title="<?php esc_attr_e( 'Pinterest', 'rara-academic' );?>"><i class="fa fa-pinterest"></i></a></li>
        <?php } if( $linkedin ){ ?>
        <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" title="<?php esc_attr_e( 'LinkedIn', 'rara-academic' );?>"><i class="fa fa-linkedin"></i></a></li>
        <?php } if( $gplus ){ ?>
        <li><a href="<?php echo esc_url( $gplus ); ?>" target="_blank" title="<?php esc_attr_e( 'Google Plus', 'rara-academic' );?>"><i class="fa fa-google-plus"></i></a></li>
        <?php } if( $instagram ){ ?>
        <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'rara-academic' );?>"><i class="fa fa-instagram"></i></a></li>
        <?php } if( $youtube ){ ?>
        <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank" title="<?php esc_attr_e( 'YouTube', 'rara-academic' );?>"><i class="fa fa-youtube"></i></a></li>
       <?php } if( $ok ){ ?>
            <li><a href="<?php echo esc_url( $ok ); ?>" target="_blank" title="<?php esc_attr_e( 'OK', 'rara-academic' );?>"><i class="fa fa-odnoklassniki"></i></a></li>
        <?php } if( $vk ){ ?>
            <li><a href="<?php echo esc_url( $vk ); ?>" target="_blank" title="<?php esc_attr_e( 'VK', 'rara-academic' );?>"><i class="fa fa-vk"></i></a></li>    
        <?php } if( $xing ){ ?>
            <li><a href="<?php echo esc_url( $xing ); ?>" target="_blank" title="<?php esc_attr_e( 'Xing', 'rara-academic' );?>"><i class="fa fa-xing"></i></a></li>
        <?php } if( $tiktok ){ ?>
            <li><a href="<?php echo esc_url( $tiktok ); ?>" target="_blank" title="<?php esc_attr_e( 'Tiktok', 'rara-academic' );?>"><i class="fab fa-tiktok"></i></a></li>
        <?php } ?>
    </ul>
    <?php
    }
}
endif;

if( ! function_exists( 'rara_academic_home_section') ):
/**
 * Check if home page section are enable or not.
*/
    function rara_academic_home_section(){
        $rara_academic_sections = array( 'banner', 'courses', 'welcome', 'service', 'notice', 'blog', 'testimonial', 'cta' );
        $enable_section = false;
        foreach( $rara_academic_sections as $section ){ 
            if( get_theme_mod( 'rara_academic_ed_' . $section . '_section' ) == 1 ){
                $enable_section = true;
            }
        }
        return $enable_section;
    }
endif;


if( ! function_exists( 'rara_academic_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function rara_academic_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'rara_academic_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function rara_academic_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'rara_academic_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'rara-academic' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'rara-academic' ), esc_html( $name ) ); ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=rara-academic-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'rara-academic' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?rara_academic_admin_notice=1"><?php esc_html_e( 'Dismiss', 'rara-academic' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'rara_academic_admin_notice' );

if( ! function_exists( 'rara_academic_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function rara_academic_update_admin_notice(){
    if ( isset( $_GET['rara_academic_admin_notice'] ) && $_GET['rara_academic_admin_notice'] = '1' ) {
        update_option( 'rara_academic_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'rara_academic_update_admin_notice' );

if( ! function_exists( 'rara_academic_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function rara_academic_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'rara-academic' ) : __( 'Name', 'rara-academic' ) );
    $email    = ( $req ? __( 'Email*', 'rara-academic' ) : __( 'Email', 'rara-academic' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'rara-academic' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'rara-academic' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'rara-academic' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'rara-academic' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'rara_academic_change_comment_form_default_fields' );

if( ! function_exists( 'rara_academic_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function rara_academic_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'rara-academic' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'rara-academic' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'rara_academic_change_comment_form_defaults' );

if( ! function_exists( 'rara_academic_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function rara_academic_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'rara_academic_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function rara_academic_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = rara_academic_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#dedbdb;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;