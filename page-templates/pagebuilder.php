<?php
/**
 * Template Name: Page Builder
 */

get_header();

	while (have_posts()) : the_post();
	ilovewp_helper_display_content($post);
	endwhile;

get_footer();