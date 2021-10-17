<?php
/**
 * Template Name: Homepage + Posts
 */

get_header();

ilovewp_helper_display_container_wrapper_start();

	while (have_posts()) : the_post();

	ilovewp_helper_display_content($post);

	endwhile;

	ilovewp_helper_display_flex_wrapper_start();
	ilovewp_helper_display_page_wrapper_start();
	
		// Display Recent Posts

		echo '<h2 class="section-title">' . esc_html(get_theme_mod( 'theme-nutmeg-string-recent-posts', __('Newest Recipes', 'nutmeg') )) . '</h2>';

		if ( is_active_sidebar('homepage-under-title') ) {
			echo '<div class="archive-description">';
			dynamic_sidebar( 'homepage-under-title' );
			echo '</div><!-- .archive-description -->';
		}

		get_template_part('loop', 'homepage');

	ilovewp_helper_display_page_wrapper_end();
	
	ilovewp_helper_display_sidebar();
	ilovewp_helper_display_flex_wrapper_end();
	ilovewp_helper_display_container_wrapper_end();

get_footer();