<?php
/**
 * The template part for header
 *
 * @package Sirat 
 * @subpackage sirat
 * @since Sirat 1.0
 */
?>
<div class="menubar">
	<?php if(has_nav_menu('primary')){ ?>
		<div class="toggle-nav mobile-menu">
		    <button onclick="sirat_menu_open_nav()" class="responsivetoggle"><i class="<?php echo esc_attr(get_theme_mod('sirat_res_menus_open_icon','fas fa-bars')); ?>"></i><span class="menu-label"><?php echo esc_html( get_theme_mod('sirat_mobile_menu_label', __('Menu','sirat'))); ?></span><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('sirat_mobile_menu_label', __('Menu','sirat'))); ?></span></button>
		</div>
	<?php } ?>
	 <div id="mySidenav" class="nav sidenav">
	    <nav id="site-navigation" class="main-menu-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'sirat' ); ?>">
	        <?php 
				if(has_nav_menu('primary')){
					wp_nav_menu( array( 
						'theme_location' => 'primary',
						'container_class' => 'main-menu clearfix' ,
						'menu_class' => 'clearfix',
						'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
						'fallback_cb' => 'wp_page_menu',
					) ); 
				} 
			?>
	        <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="sirat_menu_close_nav()"><i class="<?php echo esc_attr(get_theme_mod('sirat_res_close_menus_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','sirat'); ?></span></a>
	    </nav>
	</div>
</div>