<?php
/**
 * The template part for displaying post
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
  <div class="post-main-box wow zoomInDown delay-1000" data-wow-duration="2s">
    <?php
      if ( ! is_single() ) {
        // If not a single post, highlight the gallery.
        if ( get_post_gallery() ) {
          echo '<div class="entry-gallery">';
            echo ( get_post_gallery() );
          echo '</div>';
        };
      };
    ?>
    <h2 class="section-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
    <?php if( get_theme_mod( 'sirat_toggle_postdate',true) != '' || get_theme_mod( 'sirat_toggle_author',true) != '' || get_theme_mod( 'sirat_toggle_comments',true) != '' || get_theme_mod( 'sirat_toggle_time',true) != '') { ?>
      <div class="post-info">
        <?php if( get_theme_mod( 'sirat_toggle_postdate',true) != '' || get_theme_mod( 'sirat_toggle_postdate_hide_show',true) != '') { ?>
          <span class="entry-date"><i class="<?php echo esc_attr(get_theme_mod('sirat_toggle_postdate_icon','fas fa-calendar-alt')); ?>"></i><a href="<?php echo esc_url( get_day_link( $sirat_archive_year, $sirat_archive_month, $sirat_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
        <?php } ?>

        <?php if( get_theme_mod( 'sirat_toggle_author',true) != '' || get_theme_mod( 'sirat_toggle_author_hide_show',true) != '') { ?>
          <span class="entry-author"><span><?php echo esc_html(get_theme_mod('sirat_meta_field_separator','|'));?></span> <i class="<?php echo esc_attr(get_theme_mod('sirat_toggle_author_icon','far fa-user')); ?>"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
        <?php } ?>

        <?php if( get_theme_mod( 'sirat_toggle_comments',true) != '' || get_theme_mod( 'sirat_toggle_comments_hide_show',true) != '') { ?>
          <span class="entry-comments"><span><?php echo esc_html(get_theme_mod('sirat_meta_field_separator','|'));?></span> <i class="<?php echo esc_attr(get_theme_mod('sirat_toggle_comments_icon','fas fa-comments')); ?>"></i><?php comments_number( __('0 Comment', 'sirat'), __('0 Comments', 'sirat'), __('% Comments', 'sirat') ); ?> </span>
        <?php } ?>
        
        <?php if( get_theme_mod( 'sirat_toggle_time',true) != '' || get_theme_mod( 'sirat_toggle_time_hide_show',true) != '') { ?>
          <span class="entry-time"><span><?php echo esc_html(get_theme_mod('sirat_meta_field_separator','|'));?></span> <i class="<?php echo esc_attr(get_theme_mod('sirat_toggle_time_icon','far fa-clock')); ?>"></i><?php echo esc_html( get_the_time() ); ?></span>
        <?php }?>
      </div>
    <?php } ?>
    <div class="entry-content">
      <?php $sirat_theme_lay = get_theme_mod( 'sirat_excerpt_settings','Excerpt');
        if($sirat_theme_lay == 'Content'){ ?>
          <?php the_content(); ?>
        <?php }
        if($sirat_theme_lay == 'Excerpt'){ ?>
          <?php if(get_the_excerpt()) { ?>
            <p><?php $excerpt = get_the_excerpt(); echo esc_html( sirat_string_limit_words( $excerpt, esc_attr(get_theme_mod('sirat_excerpt_number','30')))); ?> <?php echo esc_html(get_theme_mod('sirat_excerpt_suffix',''));?></p>
          <?php }?>
        <?php }?>
    </div>
    <?php if( get_theme_mod('sirat_button_text','READ MORE') != ''){ ?>
      <div class="more-btn">
        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('sirat_button_text',__('READ MORE','sirat')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('sirat_button_text',__('READ MORE','sirat')));?></span></a>
      </div>
    <?php } ?>
  </div>
</article>