<?php
/**
 * Delicious Recipes Functions.
 *
 * @package vilva
 */

if( ! function_exists( 'vilva_recipe_category' ) ) :
/**
 * Difficulty Level.
 */
function vilva_recipe_category(){
    global $recipe;
    if ( ! empty( $recipe->ID ) ) : ?>
        <span class="post-cat">
            <?php the_terms( $recipe->ID, 'recipe-course', '', '', '' ); ?>
        </span>
    <?php endif;
}
endif;

if( ! function_exists( 'vilva_recipes_autoload_selector' ) ) :
/**
 * Recipes Autoload Selector.
 */
function vilva_recipes_autoload_selector() {
    return '.site-content > .container';
}
endif;
add_filter( 'wp_delicious_autoload_selector', 'vilva_recipes_autoload_selector' );

if( ! function_exists( 'vilva_recipes_autoload_append_selector' ) ) :
/**
 * Recipes Autoload Append Selector.
 */
function vilva_recipes_autoload_append_selector() {
    return '.content-area';
}
endif;
add_filter( 'wp_delicious_autoload_append_selector', 'vilva_recipes_autoload_append_selector' );