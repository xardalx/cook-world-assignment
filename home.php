<?php
if ( is_home() ) :

	get_template_part( 'index' );

else :

get_header(); ?>

	<?php 
	ilovewp_helper_display_page_wrapper_start();
	ilovewp_helper_display_page_intro_wrapper_start();

	ilovewp_helper_display_breadcrumbs($post);
	ilovewp_helper_display_title($post);
	
	ilovewp_helper_display_page_intro_wrapper_end();

	ilovewp_helper_display_content($post);
	ilovewp_helper_display_comments($post);
	ilovewp_helper_display_page_children($post);
	ilovewp_helper_display_page_wrapper_end();
	?>

<?php get_footer();
endif;