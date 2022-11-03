<?php
/**
 * Template Name: Ibtana Page Template
 */

get_header(); ?>

<?php do_action( 'vw_ecommerce_store_page_top' ); ?>

<main id="maincontent" role="main" class="middle-align">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
            <div id="content-vw">
                <?php the_content();?>
                <div class="clearfix"></div>
            </div> 
        <?php endwhile; ?>
    </div>
</main>

<?php do_action( 'vw_ecommerce_store_page_bottom' ); ?>

<?php get_footer(); ?>