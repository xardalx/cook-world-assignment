<?php get_header(); ?>

	<?php 
	while (have_posts()) : the_post();
	ilovewp_helper_display_container_wrapper_start();
	ilovewp_helper_display_flex_wrapper_start();
		ilovewp_helper_display_page_wrapper_start();
		
			ilovewp_helper_display_page_intro_wrapper_start();

				ilovewp_helper_display_breadcrumbs($post);
				ilovewp_helper_display_featured_image($post);
				ilovewp_helper_display_postmeta_single($post);
				ilovewp_helper_display_title($post);
			
			ilovewp_helper_display_page_intro_wrapper_end();

			ilovewp_helper_display_content($post);
			ilovewp_helper_display_authorbio($post);
			ilovewp_helper_display_after_content();
			ilovewp_helper_display_comments($post);
		
		ilovewp_helper_display_page_wrapper_end();
		
		ilovewp_helper_display_sidebar();
	ilovewp_helper_display_flex_wrapper_end();
	ilovewp_helper_display_container_wrapper_end();
	endwhile;
	?>

<?php get_footer();