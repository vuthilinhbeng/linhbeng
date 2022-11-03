<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Sirat
 */

get_header(); ?>

<div class="not container">
	<main id="content" role="main">
    	<h1><?php echo esc_html(get_theme_mod('sirat_404_page_title',__('404 Not Found','sirat')));?></h1>
		<p class="text-404"><?php echo esc_html(get_theme_mod('sirat_404_page_content',__('Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.','sirat')));?></p>
		<?php if( get_theme_mod('sirat_404_page_button_text','Go Back') != ''){ ?>
			<div class="more-btn">
		        <a href="<?php echo esc_url(home_url()); ?>"><?php echo esc_html(get_theme_mod('sirat_404_page_button_text',__('Go Back','sirat')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('sirat_404_page_button_text',__('Go Back','sirat')));?></span></a>
		    </div>
		<?php } ?>
		<div class="clearfix"></div>
	</main>
</div>

<?php get_footer(); ?>