<?php
/**
 * The header for our theme
 *
 * @subpackage supermarket-ecommerce
 * @since 1.0
 * @version 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'supermarket-ecommerce' ); ?></a>

	<?php if (get_theme_mod('supermarket_ecommerce_hide_show_topbar',false) == true) {?>
		<div id="contact-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="social-icons">
							<?php if( get_theme_mod( 'supermarket_ecommerce_facebook_url') != '') { ?>
			      				<a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
						    <?php } ?>
						    <?php if( get_theme_mod( 'supermarket_ecommerce_twitter_url') != '') { ?>
				      			<a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_twitter_url','' ) ); ?>"><i class="fab fa-twitter"></i></a>
						    <?php } ?>
						    <?php if( get_theme_mod( 'supermarket_ecommerce_insta_url') != '') { ?>
					      		<a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_insta_url','' ) ); ?>"><i class="fab fa-instagram"></i></a>
						    <?php } ?>
						    <?php if( get_theme_mod( 'supermarket_ecommerce_linkedin_url') != '') { ?>
					      		<a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_linkedin_url','' ) ); ?>"><i class="fab fa-linkedin-in"></i></a>
						    <?php } ?>	  
						    
						    <?php if( get_theme_mod( 'supermarket_ecommerce_you_tube_url') != '') { ?>
					      		<a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_you_tube_url','' ) ); ?>"><i class="fab fa-youtube"></i></a>
						    <?php } ?>
						    <?php if( get_theme_mod( 'supermarket_ecommerce_pinterest_url') != '') { ?>
					      		<a href="<?php echo esc_url( get_theme_mod( 'supermarket_ecommerce_pinterest_url','' ) ); ?>"><i class="fab fa-pinterest-p"></i></a>
						    <?php } ?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="email">
							<?php if( get_theme_mod( 'supermarket_ecommerce_call') != '') { ?>
								<span><a href="tel:<?php echo esc_attr( get_theme_mod('supermarket_ecommerce_call','') ); ?>"><i class="fas fa-phone"></i><?php echo esc_html( get_theme_mod('supermarket_ecommerce_call','') ); ?></a></span>
							<?php }?>
							<?php if( get_theme_mod( 'supermarket_ecommerce_mail') != '') { ?>
								<span><a href="mailto:<?php echo esc_attr( get_theme_mod('supermarket_ecommerce_mail','') ); ?>"><i class="fas fa-envelope"></i><?php echo esc_html( get_theme_mod('supermarket_ecommerce_mail','') ); ?></a></span>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }?>

	<header id="header">
		<div class="search-bar">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-12">
						<div class="logo">
					        <?php if ( has_custom_logo() ) : ?>
						        <div class="site-logo"><?php the_custom_logo(); ?></div>
						    <?php endif; ?>
				            <?php if (get_theme_mod('supermarket_ecommerce_show_site_title',true)) {?>
						        <?php $blog_info = get_bloginfo( 'name' ); ?>
						        <?php if ( ! empty( $blog_info ) ) : ?>
						            <?php if ( is_front_page() && is_home() ) : ?>
							            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						        	<?php else : ?>
					            		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						            <?php endif; ?>
						        <?php endif; ?>
						    <?php }?>
				        	<?php if (get_theme_mod('supermarket_ecommerce_show_tagline',true)) {?>
						        <?php
						        $description = get_bloginfo( 'description', 'display' );
						        if ( $description || is_customize_preview() ) :
						          ?>
							        <p class="site-description">
							            <?php echo esc_html($description); ?>
							        </p>
						        <?php endif; ?>
						    <?php }?>
					    </div>
					</div>
					<?php if(class_exists('woocommerce')){ ?>
						<div class="col-lg-6 col-md-7 align-self-center">
				        	<?php get_product_search_form()?>
				      	</div>
				      	<div class="col-lg-2 col-md-3 align-self-center">
				      		<div class="acc-btn">
					            <?php if(class_exists('woocommerce')){ ?>
						            <?php if ( is_user_logged_in() ) { ?>
					              		<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" ><?php esc_html_e('MY ACCOUNT','supermarket-ecommerce'); ?></a>
						            <?php } 
						            else { ?>
					              		<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" ><?php esc_html_e('LOGIN / REGISTER','supermarket-ecommerce'); ?></a>
						            <?php } ?>
						        <?php }?>
				        	</div>
				      	</div>
						<div class="col-lg-1 col-md-2 align-self-center">
						    <div class="cart_icon">
						        <a class="cart-contents" href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>"><i class="fas fa-shopping-basket"></i></a>
					            <li class="cart_box">
					              <span class="cart-value"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
					            </li>
						    </div>
					    </div>
					<?php } ?>
				</div>
			</div>
		</div>	
		<div class="menu-section">
			<div class="container">
				<div class="main-top">
				   <div class="row">
				    	<?php if(class_exists('woocommerce')){ ?>
				      	<div class="col-lg-3 col-md-4">
					        <button class="product-btn"><i class="fa fa-bars" aria-hidden="true"></i><?php esc_html_e('ALL CATEGORIES','supermarket-ecommerce'); ?></button>
					        <div class="product-cat">
					          <?php
					            $args = array(
					              //'number'     => $number,
					              'orderby'    => 'title',
					              'order'      => 'ASC',
					              'hide_empty' => 0,
					              'parent'  => 0
					              //'include'    => $ids
					            );
					            $product_categories = get_terms( 'product_cat', $args );
					            $count = count($product_categories);
					            if ( $count > 0 ){
					                foreach ( $product_categories as $product_category ) {
					                  $product_cat_id   = $product_category->term_id;
					                  $cat_link = get_category_link( $product_cat_id );
					                  if ($product_category->category_parent == 0) { ?>
					                	<li class="drp_dwn_menu"><a href="<?php echo esc_url(get_term_link( $product_category ) ); ?>">
						                <?php
						            }
					                echo esc_html( $product_category->name ); ?></a><i class="fas fa-chevron-right"></i></li>
					                <?php
					                }
					              }
					          ?>
				        	</div>
				      	</div>
				      	<?php } ?>
				      	<div class="col-lg-9 col-md-8">
				      		<?php if (has_nav_menu('primary')){ ?>
								<div class="toggle-menu responsive-menu">
						            <button onclick="supermarket_ecommerce_open()" role="tab" class="mobile-menu"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','supermarket-ecommerce'); ?></span></button>
						        </div>
								<div id="sidelong-menu" class="nav sidenav">
					                <nav id="primary-site-navigation" class="nav-menu" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'supermarket-ecommerce' ); ?>">
					                  <?php 
					                    wp_nav_menu( array( 
					                      'theme_location' => 'primary',
					                      'container_class' => 'main-menu-navigation clearfix' ,
					                      'menu_class' => 'clearfix',
					                      'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
					                      'fallback_cb' => 'wp_page_menu',
					                    ) ); 
					                  ?>
					                  <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="supermarket_ecommerce_close()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','supermarket-ecommerce'); ?></span></a>
					                </nav>
					            </div>
					        <?php }?>
						</div>
				    </div>
				</div>
			</div>
		</div>	
	</header>

	<?php if(is_singular()) {?>
		<div id="inner-pages-header">
		    <div class="header-content py-2">
			    <div class="container"> 
			      	<h1><?php single_post_title(); ?></h1>
		      	</div>
	      	</div>
	      	<div class="theme-breadcrumb py-2">
	      		<div class="container py-1">
					<?php utsav_event_planner_breadcrumb();?>
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="site-content-contain">
		<div id="content" class="site-content">