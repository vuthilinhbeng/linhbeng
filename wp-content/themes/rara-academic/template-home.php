<?php
/**
 * Template Name: Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rara Academic
 */
$sidebar_layout = rara_academic_sidebar_layout();

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">	
		<?php 
		while ( have_posts() ) : the_post(); ?> 
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>				
		        <div class="entry-content" itemprop="text">
		            <?php the_content(); ?> 
		        </div><!-- .entry-content-page -->				    
			</article><!-- #post-## -->
		<?php endwhile; ?>
	</main><!-- #main -->
</div>
<?php
if( $sidebar_layout == 'right-sidebar' ) get_sidebar();
get_footer();