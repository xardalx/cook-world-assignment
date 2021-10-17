<?php get_header(); ?>

	<?php 
	ilovewp_helper_display_container_wrapper_start();
	ilovewp_helper_display_flex_wrapper_start();
		ilovewp_helper_display_page_wrapper_start();
		
			ilovewp_helper_display_page_intro_wrapper_start();

				ilovewp_helper_display_breadcrumbs($post);

				the_archive_title( '<h1 class="archives-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );

			ilovewp_helper_display_page_intro_wrapper_end();

			get_template_part('loop');
			
		ilovewp_helper_display_page_wrapper_end();
		
		ilovewp_helper_display_sidebar();
	ilovewp_helper_display_flex_wrapper_end();
	ilovewp_helper_display_container_wrapper_end();
	?>

<?php get_footer();