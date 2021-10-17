<?php get_header(); ?>

	<?php 
	ilovewp_helper_display_container_wrapper_start();
	ilovewp_helper_display_flex_wrapper_start();
		ilovewp_helper_display_page_wrapper_start();
		
			ilovewp_helper_display_page_intro_wrapper_start();

				?><h1 class="archives-title"><?php esc_html_e('Search Results for', 'nutmeg');?>: <strong><?php the_search_query(); ?></strong></h1>
				<?php get_search_form();

			ilovewp_helper_display_page_intro_wrapper_end();

			get_template_part('loop');
			
		ilovewp_helper_display_page_wrapper_end();
		
		ilovewp_helper_display_sidebar();
	ilovewp_helper_display_flex_wrapper_end();
	ilovewp_helper_display_container_wrapper_end();
	?>

<?php get_footer();