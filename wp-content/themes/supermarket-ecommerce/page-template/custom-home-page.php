<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<?php do_action( 'supermarket_ecommerce_above_slider' ); ?>

<div class=" slider_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-9">
				<?php if( get_theme_mod('supermarket_ecommerce_slider_hide_show',false) != false){ ?>
					<section id="slider">
					  	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
						    <?php $supermarket_ecommerce_slider_pages = array();
						      	for ( $count = 1; $count <= 4; $count++ ) {
							        $mod = intval( get_theme_mod( 'supermarket_ecommerce_slider' . $count ));
							        if ( 'page-none-selected' != $mod ) {
							          	$supermarket_ecommerce_slider_pages[] = $mod;
							        }
						      	}
						      	if( !empty($supermarket_ecommerce_slider_pages) ) :
						        $args = array(
						          	'post_type' => 'page',
						          	'post__in' => $supermarket_ecommerce_slider_pages,
						          	'orderby' => 'post__in'
						        );
						        $query = new WP_Query( $args );
						        if ( $query->have_posts() ) :
						          $i = 1;
						    ?>     
						    <div class="carousel-inner" role="listbox">
						      	<?php  while ( $query->have_posts() ) : $query->the_post(); ?>
						        <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
						          	<?php the_post_thumbnail(); ?>
						          	<div class="carousel-caption">
							            <div class="inner_carousel">
							              	<h1><?php the_title(); ?></h1>
							              	<p><?php $excerpt = get_the_excerpt(); echo esc_html( supermarket_ecommerce_string_limit_words( $excerpt,10 ) ); ?></p>
							            </div>
							            <div class="read-btn">
							              <a href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'READ MORE', 'supermarket-ecommerce' ); ?>"><?php esc_html_e('READ MORE','supermarket-ecommerce'); ?>
							              </a>
								       	</div>
						          	</div>
						        </div>
						      	<?php $i++; endwhile; 
						      	wp_reset_postdata();?>
						    </div>
						    <?php else : ?>
						    <div class="no-postfound"></div>
						      <?php endif;
						    endif;?>
						    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						      <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
						    </a>
						    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						      <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
						    </a>
					  	</div>  
					  	<div class="clearfix"></div>
					</section>
				<?php }?>
			</div>
			<div class="col-lg-3 col-md-3">
				<?php if( get_theme_mod('supermarket_ecommerce_post1') != ''){ ?>
					<?php
			        $supermarket_ecommerce_postData =  get_theme_mod('supermarket_ecommerce_post1');
			        if($supermarket_ecommerce_postData){
			          	$args = array( 'name' => esc_html($supermarket_ecommerce_postData ,'supermarket-ecommerce'));
			          	$query = new WP_Query( $args );
			          	if ( $query->have_posts() ) :
				            while ( $query->have_posts() ) : $query->the_post(); ?>
				                <div class="slide-post">
				                    <strong><?php the_title(); ?></strong>
				                  	<div class=""><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
				                  	</div>
				                  	<div class="more-btn">
				                      <a href="<?php the_permalink(); ?>"><?php esc_html_e('SHOP NOW','supermarket-ecommerce'); ?></a>
				                    </div>
			               		</div>
				            <?php endwhile; 
				            wp_reset_postdata();?>
			            <?php else : ?>
			              <div class="no-postfound"></div>
			            <?php
			        endif;} ?>   
		        <?php }?>
			</div>
		</div>
	</div>
</div>
<?php do_action('supermarket_ecommerce_below_slider'); ?>

<div id="product_section">
	<div class="container">
		<?php if( get_theme_mod('supermarket_ecommerce_product_title') != ''){ ?>
			<strong><?php echo esc_html(get_theme_mod('supermarket_ecommerce_product_title','')); ?></strong>
		<?php }?>
		<div class="row m-0">
			<div class="col-lg-3 col-md-3 p-0">
				<?php
		        $supermarket_ecommerce_postData1 =  get_theme_mod('supermarket_ecommerce_post');
		        if($supermarket_ecommerce_postData1){
		          	$args = array( 'name' => esc_html($supermarket_ecommerce_postData1 ,'supermarket-ecommerce'));
		          	$query = new WP_Query( $args );
		          	if ( $query->have_posts() ) :
			            while ( $query->have_posts() ) : $query->the_post(); ?>
			                <div class="product-text">
			                	<div class="product_box">
				                    <h3><?php the_title(); ?></h3>
				                    <div class="more-btn">              
			                      		<a href="<?php the_permalink(); ?>"><?php esc_html_e('SHOP NOW','supermarket-ecommerce'); ?></a>
				                    </div>
				                </div>
			                  	<?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
		               		</div>
			            <?php endwhile; 
			            wp_reset_postdata();?>
		            <?php else : ?>
		              <div class="no-postfound"></div>
		            <?php
		        endif;} ?>  
			</div>
			<div class="col-lg-9 col-md-9 p-0">
				<?php $supermarket_ecommerce_product_pages = array();
			      	$mod = absint( get_theme_mod( 'supermarket_ecommerce_products'));
			      	if ( 'page-none-selected' != $mod ) {
			        	$supermarket_ecommerce_product_pages[] = $mod;	
			      	}
				    if( !empty($supermarket_ecommerce_product_pages) ) :
				      	$args = array(
					        'post_type' => 'page',
					        'post__in' => $supermarket_ecommerce_product_pages,
					        'orderby' => 'post__in'
				      	);
				      	$query = new WP_Query( $args );
				      	if ( $query->have_posts() ) :
					        $count = 0;
					        while ( $query->have_posts() ) : $query->the_post(); ?>
					        <?php the_content(); ?>
					        <?php $count++; endwhile; ?>
				      	<?php else : ?>
				          	<div class="no-postfound"></div>
				      	<?php endif;
				    endif;
				    wp_reset_postdata()
				?>
			</div>
		</div>
	</div>
</div>

<?php do_action('supermarket_ecommerce_below_product_section'); ?>

<div class="container lz-content">
  	<?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>