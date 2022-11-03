<?php
/**
 * The template part for displaying single post content
 *
 * @package Sirat
 * @subpackage sirat
 * @since Sirat 1.0
 */
?>
<?php 
  $sirat_archive_year  = get_the_time('Y'); 
  $sirat_archive_month = get_the_time('m'); 
  $sirat_archive_day   = get_the_time('d'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <div class="single-post">
        <h1><?php the_title(); ?></h1>
        <?php if( get_theme_mod( 'sirat_single_post_postdate',true) != '' || get_theme_mod( 'sirat_single_post_author',true) != '' || get_theme_mod( 'sirat_single_post_comments',true) != '' || get_theme_mod( 'sirat_single_post_time',true) != '') { ?>
            <div class="post-info">
                <?php if(get_theme_mod('sirat_single_post_postdate',true)==1){ ?>
                    <span class="entry-date"><i class="<?php echo esc_attr(get_theme_mod('sirat_single_post_postdate_icon','fas fa-calendar-alt')); ?>"></i><a href="<?php echo esc_url( get_day_link( $sirat_archive_year, $sirat_archive_month, $sirat_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
                <?php } ?>

                <?php if(get_theme_mod('sirat_single_post_author',true)==1){ ?>
                    <span class="entry-author"><span><?php echo esc_html(get_theme_mod('sirat_single_post_meta_field_separator','|'));?></span> <i class="<?php echo esc_attr(get_theme_mod('sirat_single_post_author_icon','far fa-user')); ?>"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
                <?php } ?>

                <?php if(get_theme_mod('sirat_single_post_comments',true)==1){ ?>
                    <span class="entry-comments"><span><?php echo esc_html(get_theme_mod('sirat_single_post_meta_field_separator','|'));?></span> <i class="<?php echo esc_attr(get_theme_mod('sirat_single_post_comments_icon','fas fa-comments')); ?>"></i><?php comments_number( __('0 Comment', 'sirat'), __('0 Comments', 'sirat'), __('% Comments', 'sirat') ); ?> </span>
                <?php } ?>
                <?php if( get_theme_mod( 'sirat_single_post_time',true) != '') { ?>
                    <span class="entry-time"><span><?php echo esc_html(get_theme_mod('sirat_single_post_meta_field_separator','|'));?></span> <i class="<?php echo esc_attr(get_theme_mod('sirat_single_post_time_icon','far fa-clock')); ?>"></i><?php echo esc_html( get_the_time() ); ?></span>
                <?php }?>
            </div>
        <?php } ?>
        <?php if( get_theme_mod( 'sirat_single_blog_featured_image_hide_show',true) != '') { ?>
            <?php if(has_post_thumbnail()) { ?>
                <div class="feature-box">   
                  <?php the_post_thumbnail(); ?>
                  <hr> 
                </div>                   
            <?php } ?>
        <?php } ?> 
        <div class="entry-content">
            <?php the_content(); ?>
            <?php if(get_theme_mod('sirat_toggle_tags',true)==1){ ?>
                <div class="tags"><?php the_tags(); ?></div> 
            <?php } ?>   
        </div> 
        <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || '0' != get_comments_number() )
            comments_template();

            if ( is_singular( 'attachment' ) ) {
                // Parent post navigation.
                the_post_navigation( array(
                    'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'sirat' ),
                ) );
            } elseif ( is_singular( 'post' ) ) {
                // Previous/next post navigation.
                the_post_navigation( array(
                    'next_text' => '<span class="meta-nav" aria-hidden="true">' .esc_html(get_theme_mod('sirat_single_blog_next_navigation_text','NEXT')) . '</span> ' .
                        '<span class="screen-reader-text">' . __( 'Next post:', 'sirat' ) . '</span> ' .
                        '<span class="post-title">%title</span>',
                    'prev_text' => '<span class="meta-nav" aria-hidden="true">' .esc_html(get_theme_mod('sirat_single_blog_prev_navigation_text','PREVIOUS')) . '</span> ' .
                        '<span class="screen-reader-text">' . __( 'Previous post:', 'sirat' ) . '</span> ' .
                        '<span class="post-title">%title</span>',
                ) );
            }
        ?>
    </div>
    <?php get_template_part('template-parts/related-posts'); ?> 
</article>