<?php
/**
 * The template part for top header
 *
 * @package Sirat 
 * @subpackage sirat
 * @since Sirat 1.0
 */
?>

<div class="middle-header <?php if( get_theme_mod( 'sirat_sticky_header', false) != '' || get_theme_mod( 'sirat_stickyheader_hide_show', false) != '') { ?> header-sticky"<?php } else { ?>close-sticky <?php } ?>">
  <div class="container">
    <?php $theme_lay = get_theme_mod( 'sirat_header_content_option','Left');
      if($theme_lay == 'Left'){ ?>
        <div class="row">
          <div class="col-lg-3 col-md-3 align-self-center">
            <div class="logo">
              <?php if ( has_custom_logo() ) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
              <?php endif; ?>
              <?php $blog_info = get_bloginfo( 'name' ); ?>
                <?php if ( ! empty( $blog_info ) ) : ?>
                  <?php if ( is_front_page() && is_home() ) : ?>
                    <?php if( get_theme_mod('sirat_logo_title_hide_show',true) != ''){ ?>
                      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php } ?>
                  <?php else : ?>
                    <?php if( get_theme_mod('sirat_logo_title_hide_show',true) != ''){ ?>
                      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php } ?>
                  <?php endif; ?>
                <?php endif; ?>
                <?php
                  $description = get_bloginfo( 'description', 'display' );
                  if ( $description || is_customize_preview() ) :
                ?>
                <?php if( get_theme_mod('sirat_tagline_hide_show',true) != ''){ ?>
                  <p class="site-description">
                    <?php echo esc_html( $description ); ?>
                  </p>
                <?php } ?>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-9 col-md-9 align-self-center">
            <?php get_template_part( 'template-parts/header/navigation' ); ?>
          </div>
        </div>
      <?php }else if($theme_lay == 'Center'){ ?>
        <div class="logo">
          <?php if ( has_custom_logo() ) : ?>
            <div class="site-logo"><?php the_custom_logo(); ?></div>
          <?php endif; ?>
          <?php $blog_info = get_bloginfo( 'name' ); ?>
            <?php if ( ! empty( $blog_info ) ) : ?>
              <?php if ( is_front_page() && is_home() ) : ?>
                <?php if( get_theme_mod('sirat_logo_title_hide_show',true) != ''){ ?>
                  <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php } ?>
              <?php else : ?>
                <?php if( get_theme_mod('sirat_logo_title_hide_show',true) != ''){ ?>
                  <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php } ?>
              <?php endif; ?>
            <?php endif; ?>
            <?php
              $description = get_bloginfo( 'description', 'display' );
              if ( $description || is_customize_preview() ) :
            ?>
            <?php if( get_theme_mod('sirat_tagline_hide_show',true) != ''){ ?>
              <p class="site-description">
                <?php echo esc_html( $description ); ?>
              </p>
            <?php } ?>
          <?php endif; ?>
        </div>
        <div class="test">
         <?php get_template_part( 'template-parts/header/navigation' ); ?>
        </div>
      <?php }else if($theme_lay == 'Right'){ ?>
        <div class="row">
          <div class="col-lg-9 col-md-9 align-self-center">
            <?php get_template_part( 'template-parts/header/navigation' ); ?>
          </div>
          <div class="col-lg-3 col-md-3 align-self-center">
            <div class="logo">
              <?php if ( has_custom_logo() ) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
              <?php endif; ?>
              <?php $blog_info = get_bloginfo( 'name' ); ?>
                <?php if ( ! empty( $blog_info ) ) : ?>
                  <?php if ( is_front_page() && is_home() ) : ?>
                    <?php if( get_theme_mod('sirat_logo_title_hide_show',true) != ''){ ?>
                      <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php } ?>
                  <?php else : ?>
                    <?php if( get_theme_mod('sirat_logo_title_hide_show',true) != ''){ ?>
                      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php } ?>
                  <?php endif; ?>
                <?php endif; ?>
                <?php
                  $description = get_bloginfo( 'description', 'display' );
                  if ( $description || is_customize_preview() ) :
                ?>
                <?php if( get_theme_mod('sirat_tagline_hide_show',true) != ''){ ?>
                  <p class="site-description">
                    <?php echo esc_html( $description ); ?>
                  </p>
                <?php } ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php } ?>
  </div>
</div>