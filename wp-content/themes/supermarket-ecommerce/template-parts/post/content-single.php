<?php
/**
 * Template part for displaying  Single Posts
 * 
 * @subpackage supermarket-ecommerce
 * @since 1.0
 * @version 1.4
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="single-post">
    <div class="article_content">
      <div class="article-text">
        <div class="metabox1"> 
          <span class="entry-author"><i class="fas fa-user"></i><?php the_author(); ?></span>
          <span class="entry-date"><i class="fas fa-calendar-alt"></i><?php the_time( get_option( 'date_format' ) ); ?></span>
          <span class="entry-comments"><i class="fas fa-comments"></i><?php comments_number( __('0 Comments','supermarket-ecommerce'), __('0 Comments','supermarket-ecommerce'), __('% Comments','supermarket-ecommerce') ); ?></span>
        </div>
        <?php the_post_thumbnail(); ?>
        <div class="entry-content"><p><?php the_content(); ?></p></div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>