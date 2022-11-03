<?php
/**
 * The template part for displaying grid post
 *
 * @package Sirat
 * @subpackage sirat
 * @since Sirat 1.0
 */
?>

<div class="col-lg-4 col-md-6">
	<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
	    <div class="post-main-box wow zoomInDown delay-1000" data-wow-duration="2s">
	    	<?php if( get_theme_mod( 'sirat_featured_image_hide_show',true) != '') { ?>
		      	<div class="box-image">
		          	<?php 
			            if(has_post_thumbnail()) { 
			              the_post_thumbnail(); 
			            }
		          	?>
		        </div>
		    <?php } ?>
	        <h2 class="section-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
	        <div class="new-text">
	        	<div class="entry-content">
			        <?php $excerpt = get_the_excerpt(); echo esc_html( sirat_string_limit_words( $excerpt, esc_attr(get_theme_mod('sirat_excerpt_number','30')))); ?> <?php echo esc_html( get_theme_mod('sirat_excerpt_suffix','') ); ?>
	        	</div>
	        </div>
	        <?php if( get_theme_mod('sirat_button_text','READ MORE') != ''){ ?>
		        <div class="more-btn">
	            	<a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('sirat_button_text',__('READ MORE','sirat')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('sirat_button_text',__('READ MORE','sirat')));?></span></a>
	          	</div>
	        <?php } ?>
	    </div>
	    <div class="clearfix"></div>
  	</article>
</div>