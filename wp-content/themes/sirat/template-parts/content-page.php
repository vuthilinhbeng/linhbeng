<?php
/**
 * The template part for displaying page content
 *
 * @package Sirat
 * @subpackage sirat
 * @since Sirat 1.0
 */
?>

<div id="content-vw">
  <div class="background-skin-page">
    <?php if(has_post_thumbnail()) {?>
      <?php the_post_thumbnail(); ?>
      <hr>
    <?php }?>
    <h1 class="vw-page-title"><?php the_title();?></h1>
    <div class="entry-content"><p><?php the_content();?></p></div>
    <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
           comments_template();
        endif;
    ?>
    <div class="clearfix"></div>
  </div>
</div>