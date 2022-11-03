<?php
/**
 * Sirat functions and definitions
 *
 * @package Sirat
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

/* Breadcrumb Begin */
function sirat_the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url( home_url() );
		echo '">';
			bloginfo('name');
		echo "</a> ";
		if (is_category() || is_single()) {
			the_category(',');
			if (is_single()) {
				echo "<span> ";
					the_title();
				echo "</span> ";
			}
		} elseif (is_page()) {
			echo "<span> ";
				the_title();
		}
	}
}

/* Theme Setup */
if ( ! function_exists( 'sirat_setup' ) ) :
 
function sirat_setup() {

	$GLOBALS['content_width'] = apply_filters( 'sirat_content_width', 640 );
	
	load_theme_textdomain( 'sirat', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('sirat-homepage-thumb',240,145,true);
	
    register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sirat' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	//selective refresh for sidebar and widgets
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', sirat_font_url() ) );
}
endif;

// Theme Activation Notice
global $pagenow;

if (is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] )) {
	add_action('admin_notices', 'sirat_activation_notice');
}

add_action( 'after_setup_theme', 'sirat_setup' );

// Notice after Theme Activation
function sirat_activation_notice() {
	echo '<div class="notice notice-success is-dismissible welcome-notice">';
		echo '<p>'. esc_html__( 'Thank you for choosing Sirat Theme. Would like to have you on our Welcome page so that you can reap all the benefits of our Sirat Theme.', 'sirat' ) .'</p>';
		echo '<span><a href="'. esc_url( admin_url( 'themes.php?page=sirat_guide' ) ) .'" class="button button-primary">'. esc_html__( 'GET STARTED', 'sirat' ) .'</a></span>';
		echo '<span class="demo-btn"><a href="'. esc_url( 'https://www.vwthemes.net/vw-sirat/' ) .'" class="button button-primary" target=_blank>'. esc_html__( 'VIEW DEMO', 'sirat' ) .'</a></span>';
		echo '<span class="upgrade-btn"><a href="'. esc_url( 'https://www.vwthemes.com/themes/multipurpose-wordpress-theme/' ) .'" class="button button-primary" target=_blank>'. esc_html__( 'UPGRADE PRO', 'sirat' ) .'</a></span>';
	echo '</div>';
}

/* Theme Widgets Setup */
function sirat_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'sirat' ),
		'description'   => __( 'Appears on blog page sidebar', 'sirat' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'sirat' ),
		'description'   => __( 'Appears on page sidebar', 'sirat' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'sirat' ),
		'description'   => __( 'Appears on page sidebar', 'sirat' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 1', 'sirat' ),
		'description'   => __( 'Appears on footer 1', 'sirat' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 2', 'sirat' ),
		'description'   => __( 'Appears on footer 2', 'sirat' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 3', 'sirat' ),
		'description'   => __( 'Appears on footer 3', 'sirat' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 4', 'sirat' ),
		'description'   => __( 'Appears on footer 4', 'sirat' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Top Bar Social Media', 'sirat' ),
		'description'   => __( 'Appears on top bar', 'sirat' ),
		'id'            => 'social-links',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'sirat' ),
		'description'   => __( 'Appears on shop page', 'sirat' ),
		'id'            => 'woocommerce-shop-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Single Product Sidebar', 'sirat' ),
		'description'   => __( 'Appears on single product page', 'sirat' ),
		'id'            => 'woocommerce-single-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'sirat_widgets_init' );

/* Theme Font URL */
function sirat_font_url() {
	$font_url      = '';
	$font_family   = array();
	$font_family[] = 'ABeeZee:400,400i';
	$font_family[] = 'Abril Fatface';
	$font_family[] = 'Acme';
	$font_family[] = 'Allura:400';
	$font_family[] = 'Anton';
	$font_family[] = 'Architects Daughter';
	$font_family[] = 'Archivo:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Arimo:400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Arsenal:400,400i,700,700i';
	$font_family[] = 'Arvo:400,400i,700,700i';
	$font_family[] = 'Alegreya:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Alfa Slab One';
	$font_family[] = 'Asap:400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Averia Serif Libre:300,300i,400,400i,700,700i';
	$font_family[] = 'Bangers';
	$font_family[] = 'Boogaloo';
	$font_family[] = 'Bad Script';
	$font_family[] = 'Barlow Condensed:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Bitter:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Bree Serif';
	$font_family[] = 'BenchNine:300,400,700';
	$font_family[] = 'Cabin:400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Cardo:400,400i,700';
	$font_family[] = 'Courgette';
	$font_family[] = 'Caveat Brush:400';
	$font_family[] = 'Cherry Swash:400,700';
	$font_family[] = 'Cormorant Garamond:300,300i,400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Crimson Text:400,400i,600,600i,700,700i';
	$font_family[] = 'Cuprum:400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Cookie';
	$font_family[] = 'Coming Soon';
	$font_family[] = 'Charm:400,700';
	$font_family[] = 'Chewy';
	$font_family[] = 'Days One';
	$font_family[] = 'Dosis:200,300,400,500,600,700,800';
	$font_family[] = 'EB Garamond:400,400i,500,500i,600,600i,700,700i,800,800i';
	$font_family[] = 'Economica:400,400i,700,700i';
	$font_family[] = 'Exo 2:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Fira Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Fredoka One';
	$font_family[] = 'Fjalla One';
	$font_family[] = 'Francois One';
	$font_family[] = 'Frank Ruhl Libre:300,400,500,700,900';
	$font_family[] = 'Gabriela:400';
	$font_family[] = 'Gloria Hallelujah';
	$font_family[] = 'Great Vibes';
	$font_family[] = 'Handlee';
	$font_family[] = 'Hammersmith One';
	$font_family[] = 'Heebo:100,200,300,400,500,700,800,900';
	$font_family[] = 'Hind:300,400,500,600,700';
	$font_family[] = 'Inconsolata:200,300,400,500,600,700,800,900';
	$font_family[] = 'Indie Flower';
	$font_family[] = 'IM Fell English SC';
	$font_family[] = 'Julius Sans One';
	$font_family[] = 'Jomhuria:400';
	$font_family[] = 'Josefin Slab:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Josefin Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Jost:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Kanit:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Kaushan Script:400';
	$font_family[] = 'Krub:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Lobster';
	$font_family[] = 'Lato:100,100i,300,300i,400,400i,700,700i,900,900i';
	$font_family[] = 'Lora:400,400i,500,500i,600,600i,700,700i';
	$font_family[] = 'Libre Baskerville:400,400i,700';
	$font_family[] = 'Lobster Two:400,400i,700,700i';
	$font_family[] = 'Merriweather:300,300i,400,400i,700,700i,900,900i';
	$font_family[] = 'Marck Script';
	$font_family[] = 'Marcellus:400';
	$font_family[] = 'Merienda One:400';
	$font_family[] = 'Monda:400,700';
	$font_family[] = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Muli';
	$font_family[] = 'Mulish:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Noto Serif:400,400i,700,700i';
	$font_family[] = 'Nunito Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
	$font_family[] = 'Overpass:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Overpass Mono:300,400,500,600,700';
	$font_family[] = 'Oxygen:300,400,700';
	$font_family[] = 'Oswald:200,300,400,500,600,700';
	$font_family[] = 'Orbitron:400,500,600,700,800,900';
	$font_family[] = 'Patua One';
	$font_family[] = 'Pacifico';
	$font_family[] = 'Padauk:400,700';
	$font_family[] = 'Playball:400';
	$font_family[] = 'Playfair Display:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Prompt:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'PT Sans:400,400i,700,700i';
	$font_family[] = 'PT Serif:400,400i,700,700i';
	$font_family[] = 'Philosopher:400,400i,700,700i';
	$font_family[] = 'Permanent Marker';
	$font_family[] = 'Poiret One';
	$font_family[] = 'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Prata:400';
	$font_family[] = 'Quicksand:300,400,500,600,700';
	$font_family[] = 'Quattrocento Sans:400,400i,700,700i';
	$font_family[] = 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Rubik:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
	$font_family[] = 'Roboto Condensed:300,300i,400,400i,700,700i';
	$font_family[] = 'Rokkitt:100,200,300,400,500,600,700,800,900';
	$font_family[] = 'Ropa Sans:400,400i';
	$font_family[] = 'Russo One';
	$font_family[] = 'Righteous';
	$font_family[] = 'Saira:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Satisfy';
	$font_family[] = 'Sen:400,700,800';
	$font_family[] = 'Slabo';
	$font_family[] = 'Source Sans Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i';
	$font_family[] = 'Shadows Into Light Two';
	$font_family[] = 'Shadows Into Light';
	$font_family[] = 'Sacramento';
	$font_family[] = 'Sail:400';
	$font_family[] = 'Shrikhand';
	$font_family[] = 'Spartan:100,200,300,400,500,600,700,800,900';
	$font_family[] = 'Staatliches';
	$font_family[] = 'Stylish:400';
	$font_family[] = 'Tangerine:400,700';
	$font_family[] = 'Titillium Web:200,200i,300,300i,400,400i,600,600i,700,700i,900';
	$font_family[] = 'Trirong:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Ubuntu:300,300i,400,400i,500,500i,700,700i';
	$font_family[] = 'Unica One';
	$font_family[] = 'VT323';
	$font_family[] = 'Varela Round';
	$font_family[] = 'Vampiro One';
	$font_family[] = 'Vollkorn:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Volkhov:400,400i,700,700i';
	$font_family[] = 'Work Sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Yanone Kaffeesatz:200,300,400,500,600,700';
	$font_family[] = 'ZCOOL XiaoWei';
	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

/* Theme enqueue scripts */
function sirat_scripts() {	
	wp_enqueue_style( 'sirat-font', sirat_font_url(), array() );
	wp_enqueue_style( 'sirat-block-style', get_theme_file_uri('/assets/css/blocks.css') );
	wp_enqueue_style( 'sirat-block-patterns-style-frontend', get_theme_file_uri('/inc/block-patterns/css/block-frontend.css') );
	wp_enqueue_style( 'bootstrap-style', esc_url(get_template_directory_uri()).'/assets/css/bootstrap.css' );
	wp_enqueue_style( 'sirat-basic-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/inline-style.php' );
	wp_add_inline_style( 'sirat-basic-style',$sirat_custom_css );
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css' );	
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()) . '/assets/js/bootstrap.js', array('jquery') ,'',true);
	wp_enqueue_script( 'jquery-superfish-js', esc_url(get_template_directory_uri()) . '/assets/js/jquery.superfish.js', array('jquery') ,'',true);
	wp_enqueue_script( 'sirat-custom-scripts-jquery', esc_url(get_template_directory_uri()) . '/assets/js/custom.js', array('jquery') );

	if (get_theme_mod('sirat_animation', true) == true){
		wp_enqueue_script( 'sirat-jquery-wow', esc_url(get_template_directory_uri()) . '/assets/js/wow.js', array('jquery') );
		wp_enqueue_style( 'sirat-animate-css', esc_url(get_template_directory_uri()).'/assets/css/animate.css' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* Enqueue the Dashicons script */
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'sirat_scripts' );

/**
 * Enqueue block editor style
 */
function sirat_block_editor_styles() {
	wp_enqueue_style( 'sirat-font', sirat_font_url(), array() );
    wp_enqueue_style( 'sirat-block-patterns-style-editor', get_theme_file_uri( '/inc/block-patterns/css/block-editor.css' ), false, '1.0', 'all' );
    wp_enqueue_style( 'font-awesome', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css' );
    wp_enqueue_style( 'bootstrap-style', esc_url(get_template_directory_uri()).'/assets/css/bootstrap.css' );
}
add_action( 'enqueue_block_editor_assets', 'sirat_block_editor_styles' );

function sirat_sanitize_dropdown_pages( $page_id, $setting ) {
  	// Ensure $input is an absolute integer.
  	$page_id = absint( $page_id );
  	// If $page_id is an ID of a published page, return it; otherwise, return the default.
  	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/*radio button sanitization*/
function sirat_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function sirat_sanitize_float( $input ) {
	return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function sirat_sanitize_number_range( $number, $setting ) {
	$number = absint( $number );
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

function sirat_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

/* Excerpt Limit Begin */
function sirat_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

define('SIRAT_FREE_THEME_DOC',__('https://www.vwthemesdemo.com/docs/free-sirat/','sirat'));
define('SIRAT_SUPPORT',__('https://wordpress.org/support/theme/sirat/','sirat'));
define('SIRAT_REVIEW',__('https://wordpress.org/support/theme/sirat/reviews','sirat'));
define('SIRAT_BUY_NOW',__('https://www.vwthemes.com/themes/multipurpose-wordpress-theme/','sirat'));
define('SIRAT_LIVE_DEMO',__('https://www.vwthemes.net/vw-sirat/','sirat'));
define('SIRAT_PRO_DOC',__('https://www.vwthemesdemo.com/docs/vw-sirat-pro/','sirat'));
define('SIRAT_FAQ',__('https://www.vwthemes.com/faqs/','sirat'));
define('SIRAT_CONTACT',__('https://www.vwthemes.com/contact/','sirat'));
define('SIRAT_CHILD_THEME',__('https://developer.wordpress.org/themes/advanced-topics/child-themes/','sirat'));

define('SIRAT_CREDIT',__('https://www.vwthemes.com/themes/free-multipurpose-wordpress-theme/','sirat'));
if ( ! function_exists( 'sirat_credit' ) ) {
	function sirat_credit(){
		echo "<a href=".esc_url(SIRAT_CREDIT)." target='_blank'>".esc_html__('Sirat WordPress Theme','sirat')."</a>";
	}
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'sirat_loop_columns');
	if (!function_exists('sirat_loop_columns')) {
	function sirat_loop_columns() {
		return get_theme_mod( 'sirat_products_per_row', '3' ); 
		// 3 products per row
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'sirat_products_per_page' );
function sirat_products_per_page( $cols ) {
  	return  get_theme_mod( 'sirat_products_per_page',9);
}

//Active Callback
function sirat_slider_slideshow(){
	if(get_theme_mod('sirat_slider_background_options') == 'Slideshow' ) {
		return true;
	}
	return false;
}

function sirat_slider_image(){
	if(get_theme_mod('sirat_slider_background_options') == 'Image' || get_theme_mod('sirat_slider_background_options') == 'Gradient' ) {
		return true;
	}
	return false;
}

function sirat_slider_gradient(){
	if(get_theme_mod('sirat_slider_background_options') == 'Gradient' ) {
		return true;
	}
	return false;
}

function sirat_slider_video(){
	if(get_theme_mod('sirat_slider_background_options') == 'Video' ) {
		return true;
	}
	return false;
}

function sirat_slider_hide_show_title(){
	if(get_theme_mod('sirat_slider_background_options') == 'Slideshow' ) {
		return true;
	}
	return false;
}

function sirat_slider_hide_show_content(){
	if(get_theme_mod('sirat_slider_background_options') == 'Slideshow' ) {
		return true;
	}
	return false;
}

function sirat_slider_hide_show_button(){
	if(get_theme_mod('sirat_slider_background_options') == 'Slideshow' ) {
		return true;
	}
	return false;
}

function sirat_slider_hide_show_button_text(){
	if(get_theme_mod('sirat_slider_background_options') == 'Image' || get_theme_mod('sirat_slider_background_options') == 'Gradient' || get_theme_mod('sirat_slider_background_options') == 'Slideshow' ) {
		return true;
	}
	return false;
}

function sirat_show_blog_post_image_color(){
	if(get_theme_mod('sirat_blog_post_featured_image_option') == 'Blog Post Image Color' ) {
		return true;
	}
	return false;
}

function sirat_blog_post_featured_image_dimension(){
	if(get_theme_mod('sirat_blog_post_featured_image_dimension') == 'custom' ) {
		return true;
	}
	return false;
}

function sirat_logo_title_hide_show(){
	if(get_theme_mod('sirat_logo_title_hide_show') == '1' ) {
		return true;
	}
	return false;
}

function sirat_tagline_hide_show(){
	if(get_theme_mod('sirat_tagline_hide_show') == '1' ) {
		return true;
	}
	return false;
}

add_action( 'wp_ajax_sirat_reset_all_settings', 'sirat_reset_all_settings' );
function sirat_reset_all_settings() {
	remove_theme_mod( 'sirat_slider_arrows' );
	remove_theme_mod( 'sirat_slider_indicator_show_hide' );
	remove_theme_mod( 'sirat_slider_background_options' );
	remove_theme_mod( 'sirat_slider_page' );
	remove_theme_mod( 'sirat_slider_title_hide_show' );
	remove_theme_mod( 'sirat_slider_content_hide_show' );
	remove_theme_mod( 'sirat_slider_button_hide_show' );
	remove_theme_mod( 'sirat_slider_button_text' );
	remove_theme_mod( 'sirat_slider_content_option' );
	remove_theme_mod( 'sirat_slider_content_padding_top_bottom' );
	remove_theme_mod( 'sirat_slider_content_padding_left_right' );
	remove_theme_mod( 'sirat_slider_excerpt_number' );
	remove_theme_mod( 'sirat_slider_opacity_color' );
	remove_theme_mod( 'sirat_slider_height' );
	remove_theme_mod( 'sirat_slider_speed' );
	remove_theme_mod( 'sirat_slider_image_overlay' );
	remove_theme_mod( 'sirat_slider_image_overlay_color' );
	remove_theme_mod( 'sirat_footer_background_color' );
	remove_theme_mod( 'sirat_footer_background_image' );
	remove_theme_mod( 'sirat_footer_text' );
	remove_theme_mod( 'sirat_copyright_font_size' );
	remove_theme_mod( 'sirat_copyright_padding_top_bottom' );
	remove_theme_mod( 'sirat_copyright_alingment' );
	remove_theme_mod( 'sirat_hide_show_scroll' );
	remove_theme_mod( 'sirat_scroll_to_top_icon' );
	remove_theme_mod( 'sirat_scroll_to_top_font_size' );
	remove_theme_mod( 'sirat_scroll_to_top_padding_top_bottom' );
	remove_theme_mod( 'sirat_scroll_to_top_width' );
	remove_theme_mod( 'sirat_scroll_to_top_height' );
	remove_theme_mod( 'sirat_scroll_to_top_border_radius' );
	remove_theme_mod( 'sirat_scroll_top_alignment' );
	wp_send_json_success(
		array(
			'success' => true,
			'message' => "Reset Completed",
		)
	);
}

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/* Customizer additions. */
require get_template_directory() . '/inc/themes-widgets/social-icon.php';

/* Customizer additions. */
require get_template_directory() . '/inc/themes-widgets/about-us-widget.php';

/* Customizer additions. */
require get_template_directory() . '/inc/themes-widgets/contact-us-widget.php';

/* Implement the About theme page */
require get_template_directory() . '/inc/getstart/getstart.php';

/* Typography */
require get_template_directory() . '/inc/typography/ctypo.php';

/* Block Pattern */
require get_template_directory() . '/inc/block-patterns/block-patterns.php';

/* TGM Plugin Activation */
require get_template_directory() . '/inc/tgm/tgm.php';

/* Plugin Activation */
require get_template_directory() . '/inc/getstart/plugin-activation.php';

/* Webfonts */
require get_template_directory() . '/inc/wptt-webfont-loader.php';