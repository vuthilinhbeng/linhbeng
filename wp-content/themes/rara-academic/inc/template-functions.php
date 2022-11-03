<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Rara_Academic
 */


if( ! function_exists( 'rara_academic_doctype_cb' ) ) :
/**
 * Doctype Declaration
 * 
*/
function rara_academic_doctype_cb(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'rara_academic_doctype', 'rara_academic_doctype_cb');

if( ! function_exists( 'rara_academic_head' ) ) :
/**
 * Before wp_head
 *
*/
function rara_academic_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
}
endif;
add_action( 'rara_academic_before_wp_head', 'rara_academic_head');

if( ! function_exists( 'rara_academic_page_start' ) ) :
/**
 * Page Start
 * 
*/
function rara_academic_page_start(){
    ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#acc-content"><?php esc_html_e( 'Skip to content (Press Enter)', 'rara-academic' ); ?></a>
    <?php
}
endif;
add_action( 'rara_academic_before_page_start','rara_academic_page_start');

if( ! function_exists( 'rara_academic_header_start' ) ) :
/**
 * Header Start
 * 
*/
function rara_academic_header_start(){
    ?>
    <header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">       
    <?php 
}
endif;
add_action( 'rara_academic_header', 'rara_academic_header_start', 10 );

if( ! function_exists( 'rara_academic_header_top' ) ) :
/**
 * Header Top
 * 
*/
function rara_academic_header_top(){ ?>
    <div class="header-top">
        <div class="container">        
            <?php 
                $email     = get_theme_mod( 'rara_academic_email_address' );
                $phone     = get_theme_mod( 'rara_academic_phone' );
                $ed_social = get_theme_mod( 'rara_academic_ed_social' );

                if( $email ) echo '<a href="' . esc_url( 'mailto:' . sanitize_email( $email ) ) . '" class="email"><i class="fa fa-envelope-o"></i>' . esc_html( $email ) .'</a>';
                
                if( $phone ) echo '<a href="' . esc_url( 'tel:' . preg_replace( '/[^\d+]/', '', $phone ) ) . '" class="tel-link"><i class="fa fa-phone"></i>' . esc_html( $phone ) . '</a>';
                    
                if( $ed_social ) rara_academic_get_social_links();
            ?>		
        </div>
    </div>
    <?php
}
endif;
add_action( 'rara_academic_header', 'rara_academic_header_top', 20 );

if( ! function_exists( 'rara_academic_header_bottom' ) ) :
/**
 * Header Bottom
 * 
*/
function rara_academic_header_bottom(){ ?>
    <div class="header-bottom">
        <div class="container">
            <div class="site-branding" itemscope itemtype="https://schema.org/Organization">
                <?php 
                    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                        echo "<div class='site-logo'>";
                            the_custom_logo();
                        echo "</div>";
                    } 
                ?>
                <div class="title-tagline">
                    <?php if ( is_front_page() ) : ?>
                        <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif;
                    $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                    <?php endif; ?>
                </div>
            </div><!-- .site-branding -->

            <button class="menu-opener" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="mobile-menu-wrapper">
                <nav id="mobile-site-navigation" class="main-navigation mobile-navigation">        
                    <div class="primary-menu-list main-menu-modal cover-modal" data-modal-target-string=".main-menu-modal">
                        <button class="close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal"></button>
                        <div class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'rara-academic' ); ?>">
                            <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu_id'        => 'mobile-primary-menu',
                                    'menu_class'     => 'nav-menu main-menu-modal',
                                ) );
                            ?>
                        </div>
                    </div>
                </nav><!-- #mobile-site-navigation -->
            </div>

            <nav id="site-navigation" class="main-navigation" role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
        
        </div>
    </div>
    <?php 
}
endif;
add_action( 'rara_academic_header', 'rara_academic_header_bottom', 30 );

if( ! function_exists( 'rara_academic_header_end' ) ) :
/**
 * Header End
 * 
*/
function rara_academic_header_end(){
    ?>
    </header>
    <?php
}
endif;
add_action( 'rara_academic_header', 'rara_academic_header_end', 40 );

if( ! function_exists( 'rara_academic_header' ) ):
/**
 * Page Header 
*/
function rara_academic_main_header(){
    echo '<div id="acc-content">';
    $ed_bc = get_theme_mod( 'rara_academic_ed_breadcrumb' );
    $enabled_sections = rara_academic_home_section();
    
    if( ! is_front_page() && ! is_page_template( 'template-home.php' ) ){    
        if( $ed_bc ){?>
            <div class="page-header">
                <div class="container">            
                    <?php do_action( 'rara_academic_breadcrumbs' ); ?>
                </div>
            </div>
            <?php  
        }
    } 
    if( is_home() || ! $enabled_sections || ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){ ?>
        <div id="content" class="site-content">
            <div class="container">
                <div class="row">
        <?php
    }
}
endif;
add_action( 'rara_academic_page_header', 'rara_academic_main_header', 10 );
        
if( !function_exists( 'rara_academic_breadcrumbs_cb' ) ):
/**
 * Breadcrumb
*/
function rara_academic_breadcrumbs_cb() {    
    global $post;
    $ed_breadcrumb = get_theme_mod( 'rara_academic_ed_breadcrumb' );
    $post_page   = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front  = get_option( 'show_on_front' ); //What to show on the front page
    $showCurrent = get_theme_mod( 'rara_academic_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $delimiter   = get_theme_mod( 'rara_academic_breadcrumb_separator', __( '>', 'rara-academic' ) ); // delimiter between crumbs
    $home        = get_theme_mod( 'rara_academic_breadcrumb_home_text', __( 'Home', 'rara-academic' ) ); // text for the 'Home' link
    $before      = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb      
    $depth = 1;    

    if ( $ed_breadcrumb ){
        echo '<div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '" class="home_crumb"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            if( is_home() && ! is_front_page() ){            
                $depth = 2;
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;          
            }elseif( is_category() ){            
                $depth = 2;
                $thisCat = get_category( get_query_var( 'cat' ), false );
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                    $depth ++;  
                }

                if ( $thisCat->parent != 0 ) {
                    $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                    $parent_categories = explode( ',', $parent_categories );

                    foreach ( $parent_categories as $parent_term ) {
                        $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                        if( is_object( $parent_obj ) ){
                            $term_url    = get_term_link( $parent_obj->term_id );
                            $term_name   = $parent_obj->name;
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }

                if( $showCurrent ) echo $before . '<span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;

            }elseif( is_tag() ){            
                $queried_object = get_queried_object();
                $depth = 2;

                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;    
            }elseif( is_author() ){            
                $depth = 2;
                global $author;
                $userdata = get_userdata( $author );
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $userdata->display_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
            }elseif( is_day() ){            
                $depth = 2;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'rara-academic' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'rara-academic' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'rara-academic' ) ), get_the_time( __( 'm', 'rara-academic' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'rara-academic' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'd', 'rara-academic' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                 
            }elseif( is_month() ){            
                $depth = 2;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'rara-academic' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'rara-academic' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth++;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'F', 'rara-academic' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
            }elseif( is_year() ){            
                $depth = 2;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'rara-academic' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
            }elseif( is_single() && !is_attachment() ) {
                //For Woocommerce single product            
                if( rara_academic_is_woocommerce_activated() && 'product' === get_post_type() ){ 
                    if ( wc_get_page_id( 'shop' ) ) { 
                        //Displaying Shop link in woocommerce archive page
                        $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                        if ( ! $_name ) {
                            $product_post_type = get_post_type_object( 'product' );
                            $_name = $product_post_type->labels->singular_name;
                        }
                        echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
                    }
                
                    if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                        $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                        $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                        $ancestors = array_reverse( $ancestors );

                        foreach ( $ancestors as $ancestor ) {
                            $ancestor = get_term( $ancestor, 'product_cat' );    
                            if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                                $depth++;
                            }
                        }
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                    }
                
                    if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                                   
                }else{ 
                    //For Post                
                    $cat_object       = get_the_category();
                    $potential_parent = 0;
                    $depth            = 2;
                    
                    if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                        $p = get_post( $post_page );
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';  
                        $depth++;
                    }
                    
                    if( is_array( $cat_object ) ){ //Getting category hierarchy if any
            
                        //Now try to find the deepest term of those that we know of
                        $use_term = key( $cat_object );
                        foreach( $cat_object as $key => $object ){
                            //Can't use the next($cat_object) trick since order is unknown
                            if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                                $use_term = $key;
                                $potential_parent = $object->term_id;
                            }
                        }
                        
                        $cat = $cat_object[$use_term];
                  
                        $cats = get_category_parents( $cat, false, ',' );
                        $cats = explode( ',', $cats );

                        foreach ( $cats as $cat ) {
                            $cat_obj = get_term_by( 'name', $cat, 'category' );
                            if( is_object( $cat_obj ) ){
                                $term_url    = get_term_link( $cat_obj->term_id );
                                $term_name   = $cat_obj->name;
                                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                                $depth ++;
                            }
                        }
                    }
        
                    if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                                 
                }        
            }elseif( is_page() ){            
                $depth = 2;
                if( $post->post_parent ){            
                    global $post;
                    $depth = 2;
                    $parent_id  = $post->post_parent;
                    $breadcrumbs = array();
                    
                    while( $parent_id ){
                        $current_page  = get_post( $parent_id );
                        $breadcrumbs[] = $current_page->ID;
                        $parent_id     = $current_page->post_parent;
                    }
                    $breadcrumbs = array_reverse( $breadcrumbs );
                    for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                        if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                        $depth++;
                    }

                    if ( $showCurrent ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;      
                }else{
                    if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
                }
            }elseif( is_search() ){            
                $depth = 2;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html__( 'Search Results for "', 'rara-academic' ) . esc_html( get_search_query() ) . esc_html__( '"', 'rara-academic' ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
            }elseif( rara_academic_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ 
                //For Woocommerce archive page        
                $depth = 2;
                if ( wc_get_page_id( 'shop' ) ) { 
                    //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
                }
                $current_term = $GLOBALS['wp_query']->get_queried_object();
                if( is_product_category() ){
                    $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }           
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $current_term->name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;           
            }elseif( rara_academic_is_woocommerce_activated() && is_shop() ){ //Shop Archive page
                $depth = 2;
                if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                    return;
                }
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
        
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;                    
            }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {            
                $depth = 2;
                $post_type = get_post_type_object(get_post_type());
                if( get_query_var('paged') ){
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                    echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'rara-academic'), get_query_var('paged') ) . $after;
                }elseif( is_archive() ){
                    echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                }else{
                    echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                }              
            }elseif( is_attachment() ){            
                $depth  = 2;
                $parent = get_post( $post->post_parent );
                $cat    = get_the_category( $parent->ID );
                if( $cat ){
                    $cat = $cat[0];
                    echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
                }
                if( $showCurrent ) echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;   
            }elseif ( is_404() ){
                if( $showCurrent ) echo $before . esc_html__( '404 Error - Page not Found', 'rara-academic' ) . $after;
            }
            if( get_query_var('paged') ) echo __( ' (Page', 'rara-academic' ) . ' ' . get_query_var('paged') . __( ')', 'rara-academic' );        
            echo '</div>';
    }
} // end rara_academic_breadcrumbs()
endif;
add_action( 'rara_academic_breadcrumbs', 'rara_academic_breadcrumbs_cb' );

if( ! function_exists( 'rara_academic_post_author' ) ) :
/**
 * Author Bio
 * 
*/
function rara_academic_post_author(){
    if( get_the_author_meta( 'description' ) ){
    ?>
    <section class="author-section">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 98 ); ?>
    	<div class="text">
			<span class="name"><?php printf( esc_html__( 'Posted by %s', 'rara-academic' ), get_the_author_meta( 'display_name' ) ); ?></span>				
			<?php echo wpautop( esc_html( get_the_author_meta( 'description' ) ) ); ?>
		</div>
	</section>
    <?php  
    }  
}
endif;
add_action( 'rara_academic_after_post_content', 'rara_academic_post_author', 20 );

if( ! function_exists( 'rara_academic_content_end' ) ) :
/**
 * Content End
 *
*/
function rara_academic_content_end(){
    $enabled_sections = rara_academic_home_section();
    if( is_home() || ! $enabled_sections || ! ( is_front_page()  || is_page_template( 'template-home.php' ) ) ){ 
    ?>
                </div><!-- row -->
            </div><!-- .container -->
        </div><!-- #content -->        
    <?php
    }
}
endif;
add_action( 'rara_academic_after_content', 'rara_academic_content_end', 20 );

if( ! function_exists( 'rara_academic_footer_start' ) ) :
/**
 * Footer Start
 * 
*/
function rara_academic_footer_start(){
    ?>
    <footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">
        <div class="container">
    <?php
}
endif;
add_action( 'rara_academic_footer', 'rara_academic_footer_start', 10 );

if( ! function_exists( 'rara_academic_footer_top' ) ) :
/**
 * Footer Top
 * 
*/
function rara_academic_footer_top(){    
    if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) || is_active_sidebar( 'footer-four' ) ){
    ?>
        <div class="widget-area">
            <div class="row">
                
                <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
                    <div class="column">
                        <?php dynamic_sidebar( 'footer-one' ); ?>	
                    </div>
                <?php } ?>
                
                <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                    <div class="column">
                        <?php dynamic_sidebar( 'footer-two' ); ?>	
                    </div>
                <?php } ?>
                
                <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                    <div class="column">
                        <?php dynamic_sidebar( 'footer-three' ); ?>	
                    </div>
                <?php } ?>

                <?php if( is_active_sidebar( 'footer-four' ) ){ ?>
                    <div class="column">
                        <?php dynamic_sidebar( 'footer-four' ); ?>	
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php 
    }   
}
endif;
add_action( 'rara_academic_footer', 'rara_academic_footer_top', 20 );

if( ! function_exists( 'rara_academic_footer_bottom' ) ) :
/**
 * Footer Bottom
 * 
*/
function rara_academic_footer_bottom(){
    $copyright_text = get_theme_mod( 'rara_academic_footer_copyright_text' ); ?>
    <div class="site-info">
        <p><?php 

            if( $copyright_text ){
                echo wp_kses_post( $copyright_text );
            }else{
                echo esc_html__( '&copy; Copyright ', 'rara-academic' ) . esc_html( date_i18n( __( 'Y', 'rara-academic' ) ) ); ?> 
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>.
            <?php }  ?>

            <?php echo esc_html__( 'Rara Academic | Developed By ', 'rara-academic' ); ?>
            <a href="<?php echo esc_url( 'https://rarathemes.com/' ); ?>" rel="nofollow" target="_blank"><?php echo esc_html__( 'Rara Theme', 'rara-academic' ); ?></a>.
            <?php printf( esc_html__( 'Powered by %s', 'rara-academic' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'rara-academic' ) ) .'" target="_blank">WordPress</a>.' ); ?>
            <?php if ( function_exists( 'the_privacy_policy_link' ) ) {
                the_privacy_policy_link();
                } ?>
        </p>
        <?php if( has_nav_menu( 'secondary' ) ){ ?>
                <ul class="tags">
                    <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'fallback_cb' => false , 'depth' => 1 ) ); ?>
                </ul>
        <?php } ?>
    </div>
    <?php 
}
endif;
add_action( 'rara_academic_footer', 'rara_academic_footer_bottom', 30 );

if( ! function_exists( 'rara_academic_footer_end' ) ) :
/**
 * Footer End
 *
*/
function rara_academic_footer_end(){
    ?>
    </div>
    </footer><!-- #colophon -->
    <div class="overlay"></div>
    <?php
}
endif;
add_action( 'rara_academic_footer', 'rara_academic_footer_end', 40 );

if( ! function_exists( 'rara_academic_page_end' ) ) :
/**
 * Page End
 * 
*/
function rara_academic_page_end(){
    ?>
    </div><!-- #acc-content -->
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'rara_academic_after_footer', 'rara_academic_page_end', 20 );