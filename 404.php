<?php get_header(); ?>

	<?php 
	ilovewp_helper_display_container_wrapper_start();
	ilovewp_helper_display_flex_wrapper_start();
		ilovewp_helper_display_page_wrapper_start();
		
			ilovewp_helper_display_page_intro_wrapper_start();

				?>
				<h1 class="page-title"><?php esc_html_e( '404: Page not found', 'nutmeg' ); ?></h1>
				<div class="archives-content clearfix"><p><?php esc_html_e( 'Apologies, but the requested page cannot be found. Perhaps searching will help find a related page.', 'nutmeg' ); ?></p></div>
				<?php

				get_search_form();
			
			ilovewp_helper_display_page_intro_wrapper_end();
		
		ilovewp_helper_display_page_wrapper_end();
		
		ilovewp_helper_display_sidebar();
	ilovewp_helper_display_flex_wrapper_end();
	ilovewp_helper_display_container_wrapper_end();
	?>

<?php get_footer(); ?>