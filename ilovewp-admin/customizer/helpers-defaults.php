<?php
function ilovewp_option_defaults() {

	$defaults = array();

	$defaults_all = array(

        // Quick Vars
		'color-primary-text'					=> '#080808',
		'color-secondary-text'					=> '#585858',
		'color-link'							=> '#007777',
		'color-link-hover'						=> '#b53700',
		'color-primary-accent'					=> '#028080',
		'color-primary-accent-complementary' 	=> '#ffffff',
		'color-pattern-background'				=> '#fbf5e5',
		'color-footer-background'				=> '#f5f4f2',
		'color-neutral-color-100'				=> '#ffffff',
		'color-neutral-color-900'				=> '#080808',

        // General
		'color-body-text'						=> '',
		'color-body-link'						=> '',
		'color-body-link-hover'					=> '',
		'color-widget-title'             		=> '',
		'color-widget-title-accent'      		=> '',

        // General
		'theme-nutmeg-sidebar-position'					=> 'right',
		'theme-nutmeg-transform-animation-thumbnails'	=> 1,
		'theme-nutmeg-display-comments-posts'          	=> 1,
		'theme-nutmeg-display-comments-pages'          	=> 0,
		
		// Header
		'theme-nutmeg-header-layout'						=> '3',
		'theme-nutmeg-display-premasthead'					=> 1,
		'theme-nutmeg-display-header-searchform'			=> 1,

		'theme-nutmeg-footer-columns'						=> 3,

		// Homepage
		'theme-nutmeg-recent-posts-category'			=> 'recipes',
		'theme-nutmeg-recent-posts-num'					=> '4',
		'theme-nutmeg-display-homepage-bloglink'		=> 1,

        // Archive Pages
		'theme-nutmeg-archives-layout'                 	=> 'columns-2',
		'theme-nutmeg-archives-style'					=> 'card',
		'theme-nutmeg-archives-display-thumbnail'      	=> 1,
		'theme-nutmeg-archives-thumbnail-size'			=> 'post-thumbnail',
		'theme-nutmeg-archives-display-date'           	=> 0,
		'theme-nutmeg-archives-display-category'       	=> 1,
		'theme-nutmeg-archives-display-excerpt'        	=> 1,
		'theme-nutmeg-archives-display-author'			=> 0,
		'theme-nutmeg-archives-display-author_withdate'	=> 0,
		'theme-nutmeg-archives-display-readmore'       	=> 1,

        // Single Posts
		'theme-nutmeg-single-thumbnail-position'					=> 'float-left',
		'theme-nutmeg-single-display-date'              			=> 1,
		'theme-nutmeg-single-display-category'          			=> 1,
		'theme-nutmeg-single-display-tags'							=> 1,
		'theme-nutmeg-single-display-post-navigation'				=> 1,
		'theme-nutmeg-single-display-post-navigation-thumbnails'	=> 1,
		'theme-nutmeg-single-display-author-bio'					=> 1,
		'theme-nutmeg-single-display-author-social'					=> 1,


        // Strings
		'theme-nutmeg-string-header'					=> esc_html__('Nutmeg is a powerful WordPress theme.','nutmeg'),
		'theme-nutmeg-string-recent-posts'              => esc_html__('Newest Recipes','nutmeg'),
		'theme-nutmeg-string-readmore'                  => esc_html__('View Recipe','nutmeg'),
		'theme-nutmeg-string-bloglink'					=> esc_html__('View More Recipes','nutmeg'),
		'theme-nutmeg-string-open-menu'                 => esc_html__('Menu','nutmeg'),
		'theme-nutmeg-string-close-menu'                => esc_html__('Menu','nutmeg'),
		'theme-nutmeg-footer-text'                      => sprintf( esc_html__( 'Copyright &copy; %1$s %2$s. ', 'nutmeg' ), date( 'Y' ), get_bloginfo( 'name' ) )

	);

	return $defaults_all;
}

/**
* Get the preset values for the chosen option preset.
*/
function ilovewp_option_preset( $which ) {
	$values = array();
	if ( 'defaults' === $which || 'curiosity' === $which ) {
		$values = ilovewp_option_defaults();
	}

	return apply_filters( 'ilovewp_option_preset', $values, $which );
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function ilovewp_get_default( $option ) {

	if ( !is_customize_preview() ) {
		global $theme_customizer_defaults;
	}

	if ( !isset($theme_customizer_defaults) ) {
		$theme_customizer_defaults = ilovewp_option_defaults();
	}
	
	// $theme_customizer_defaults = ilovewp_option_defaults();
	$default  = ( isset( $theme_customizer_defaults[ $option ] ) ) ? $theme_customizer_defaults[ $option ] : false;

	return $default;
}

function ilovewp_get_all_defaults() {
	$theme_customizer_defaults = ilovewp_option_defaults();
	return $theme_customizer_defaults;
}

function ilovewp_get_a_default($array, $id) {
	$default  = ( isset( $array[ $id ] ) ) ? $array[ $id ] : false;
	return $default;
}