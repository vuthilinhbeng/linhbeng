<?php
/**
 * The template for displaying search forms in Sirat
 *
 * @package Sirat
 */
?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'sirat' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( get_theme_mod('sirat_search_placeholder', __('Search', 'sirat')) ); ?>" value="<?php echo esc_attr(get_search_query()) ?>" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button','sirat' ); ?>">
</form>