<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Rara_Academic
 */

if ( ! function_exists( 'rara_academic_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function rara_academic_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = sprintf(
		esc_html_x( 'BY %s', 'post author', 'rara-academic' ),
		'<span class="authors vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'rara-academic' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'rara_academic_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function rara_academic_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && is_single() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'rara-academic' ) );
		if ( $categories_list && rara_academic_categorized_blog() ) {
			echo '<span class="cat-links"><i class="fa fa-folder-open" aria-hidden="true"></i>' . $categories_list . '</span>'; // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'rara-academic' ) );
		if ( $tags_list ) {
			echo '<span class="tags-links"><i class="fa fa-tags" aria-hidden="true"></i>' . $tags_list . '</span>'; // WPCS: XSS OK.
		}
	}
	
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'rara-academic' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function rara_academic_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'rara_academic_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'rara_academic_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so rara_academic_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so rara_academic_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in rara_academic_categorized_blog.
 */
function rara_academic_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'rara_academic_categories' );
}
add_action( 'edit_category', 'rara_academic_category_transient_flusher' );
add_action( 'save_post',     'rara_academic_category_transient_flusher' );

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'rara_academic_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function rara_academic_fonts_url() {
	$fonts_url = '';

	/*
	* translators: If there are characters in your language that are not supported
	* by PT Sans, translate this to 'off'. Do not translate into your own language.
	*/
	$pt_sans = _x( 'on', 'PT Sans font: on or off', 'rara-academic' );
	
	/*
	* translators: If there are characters in your language that are not supported
	* by Bitter, translate this to 'off'. Do not translate into your own language.
	*/
	$bitter = _x( 'on', 'Bitter font: on or off', 'rara-academic' );

	if ( 'off' !== $pt_sans || 'off' !== $bitter ) {
		$font_families = array();

		if( 'off' !== $pt_sans ){
			$font_families[] = 'PT Sans:400,700';
		}

		if( 'off' !== $bitter ){
			$font_families[] = 'Bitter:700';
		}

		$query_args = array(
			'family'  => urlencode( implode( '|', $font_families ) ),
			'display' => urlencode( 'fallback' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url( $fonts_url );
}
endif;

if( ! function_exists( 'rara_academic_load_preload_local_fonts') ) :
/**
 * Get the file preloads.
 *
 * @param string $url    The URL of the remote webfont.
 * @param string $format The font-format. If you need to support IE, change this to "woff".
 */
function rara_academic_load_preload_local_fonts( $url, $format = 'woff2' ) {

	// Check if cached font files data preset present or not. Basically avoiding 'rara_academic_WebFont_Loader' class rendering.
	$local_font_files = get_site_option( 'rara_academic_local_font_files', false );

	if ( is_array( $local_font_files ) && ! empty( $local_font_files ) ) {
		$font_format = apply_filters( 'rara_academic_local_google_fonts_format', $format );
		foreach ( $local_font_files as $key => $local_font ) {
			if ( $local_font ) {
				echo '<link rel="preload" href="' . esc_url( $local_font ) . '" as="font" type="font/' . esc_attr( $font_format ) . '" crossorigin>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}	
		}
		return;
	}

	// Now preload font data after processing it, as we didn't get stored data.
	$font = rara_academic_webfont_loader_instance( $url );
	$font->set_font_format( $format );
	$font->preload_local_fonts();
}
endif;

if( ! function_exists( 'rara_academic_flush_local_google_fonts' ) ){
	/**
	 * Ajax Callback for flushing the local font
	 */
	function rara_academic_flush_local_google_fonts() {
		$WebFontLoader = new Rara_Academic_WebFont_Loader();
		//deleting the fonts folder using ajax
		$WebFontLoader->delete_fonts_folder();
	die();
	}
}
add_action( 'wp_ajax_flush_local_google_fonts', 'rara_academic_flush_local_google_fonts' );
add_action( 'wp_ajax_nopriv_flush_local_google_fonts', 'rara_academic_flush_local_google_fonts' );