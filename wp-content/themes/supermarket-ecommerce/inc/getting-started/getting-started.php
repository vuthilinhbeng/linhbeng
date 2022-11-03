<?php
//about theme info
add_action( 'admin_menu', 'supermarket_ecommerce_gettingstarted' );
function supermarket_ecommerce_gettingstarted() {    	
	add_theme_page( esc_html__('About Theme', 'supermarket-ecommerce'), esc_html__('About Theme', 'supermarket-ecommerce'), 'edit_theme_options', 'supermarket_ecommerce_guide', 'supermarket_ecommerce_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function supermarket_ecommerce_admin_theme_style() {
   wp_enqueue_style('custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getting-started/getting-started.css');
}
add_action('admin_enqueue_scripts', 'supermarket_ecommerce_admin_theme_style');

//guidline for about theme
function supermarket_ecommerce_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'supermarket-ecommerce' );

?>

<div class="wrapper-info">
	<div class="col-left">
		<div class="intro">
			<h3><?php esc_html_e( 'Welcome to Supermarket Ecommerce WordPress Theme', 'supermarket-ecommerce' ); ?> <span>Version: <?php echo esc_html($theme['Version']);?></span></h3>
		</div>
		<div class="started">
			<hr>
			<div class="free-doc">
				<div class="lz-4">
					<h4><?php esc_html_e( 'Start Customizing', 'supermarket-ecommerce' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Go to', 'supermarket-ecommerce' ); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizer', 'supermarket-ecommerce' ); ?> </a> <?php esc_html_e( 'and start customizing your website', 'supermarket-ecommerce' ); ?></span>
					</ul>
				</div>
				<div class="lz-4">
					<h4><?php esc_html_e( 'Support', 'supermarket-ecommerce' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Send your query to our', 'supermarket-ecommerce' ); ?> <a href="<?php echo esc_url( SUPERMARKET_ECOMMERCE_SUPPORT ); ?>" target="_blank"> <?php esc_html_e( 'Support', 'supermarket-ecommerce' ); ?></a></span>
					</ul>
				</div>
			</div>
			<p><?php esc_html_e( 'Supermarket ecommerce is an exceptional WordPress theme and if you are interested to do a great business by opening a supermarket store, this is the exceptional choice and because of its multipurpose nature, you can sell anything under the sun when it comes to retail stores. This particular theme is of immense benefit in case you are interested in opening up an online apparel and fashion accessories store. It is good for not only the cosmetics shops but also for the sports equipment shop, jewellery store or the mobile store. With supermarket eCommerce WordPress theme you can set up the online store for grocery or the food delivery. It has almost all the right features that can take your business across boundaries and you can display all the relevant business information and do the entire product sale online.  Because of its core compatibility with the WooCommerce plugin, it has a special design for the shops a well as ecommerce sites and you can open all types of stores right from fashion to technology and the ultimate credit goes to its multipurpose, minimal and elegant features apart from being responsive as well as sophisticated. Above all, it is beautiful and responsive feature makes it adjustable with various screen sizes.', 'supermarket-ecommerce')?></p>
			<hr>			
			<div class="col-left-inner">
				<h3><?php esc_html_e( 'Get started with Free Supermarket Ecommerce Theme', 'supermarket-ecommerce' ); ?></h3>
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/customizer-image.png" alt="" />
			</div>
		</div>
	</div>
	<div class="col-right">
		<div class="col-left-area">
			<h3><?php esc_html_e('Premium Theme Information', 'supermarket-ecommerce'); ?></h3>
			<hr>
		</div>
		<div class="centerbold">
			<a href="<?php echo esc_url( SUPERMARKET_ECOMMERCE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'supermarket-ecommerce'); ?></a>
			<a href="<?php echo esc_url( SUPERMARKET_ECOMMERCE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'supermarket-ecommerce'); ?></a>
			<a href="<?php echo esc_url( SUPERMARKET_ECOMMERCE_PRO_DOCS ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'supermarket-ecommerce'); ?></a>
			<hr class="secondhr">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/supermarket-ecommerce.jpg" alt="" />
		</div>
		<h3><?php esc_html_e( 'PREMIUM THEME FEATURES', 'supermarket-ecommerce'); ?></h3>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon01.png" alt="" />
			<h4><?php esc_html_e( 'Banner Slider', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon02.png" alt="" />
			<h4><?php esc_html_e( 'Theme Options', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon03.png" alt="" />
			<h4><?php esc_html_e( 'Custom Innerpage Banner', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon04.png" alt="" />
			<h4><?php esc_html_e( 'Custom Colors and Images', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon05.png" alt="" />
			<h4><?php esc_html_e( 'Fully Responsive', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon06.png" alt="" />
			<h4><?php esc_html_e( 'Hide/Show Sections', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon07.png" alt="" />
			<h4><?php esc_html_e( 'Woocommerce Support', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon08.png" alt="" />
			<h4><?php esc_html_e( 'Limit to display number of Posts', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon09.png" alt="" />
			<h4><?php esc_html_e( 'Multiple Page Templates', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon10.png" alt="" />
			<h4><?php esc_html_e( 'Custom Read More link', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon11.png" alt="" />
			<h4><?php esc_html_e( 'Code written with WordPress standard', 'supermarket-ecommerce'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon12.png" alt="" />
			<h4><?php esc_html_e( '100% Multi language', 'supermarket-ecommerce'); ?></h4>
		</div>
	</div>
</div>
<?php } ?>