<?php 
/*-----------------------------------------------------------------------------------*/
/* Initializing Widgetized Areas (Sidebars)
/*-----------------------------------------------------------------------------------*/

function nutmeg_widgetized_areas_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar: Primary', 'nutmeg' ),
		'id'            => 'sidebar-primary',
		'description'   => esc_html__( 'This is the main sidebar that will appear to the left or to the right of the content on a page.', 'nutmeg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content-wrapper">',
		'after_widget'  => '</div><!-- .widget-content-wrapper --></div>',
		'before_title'  => '<p class="widget-title"><span>',
		'after_title'   => '</span></p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Full Width', 'nutmeg' ),
		'id'            => 'footer-fullwidth-1',
		'description'   => esc_html__( 'These widgets will appear at the beginning of the website footer. This area is unstyled and has no padding and no margin.', 'nutmeg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content-wrapper">',
		'after_widget'  => '</div><!-- .widget-content-wrapper --></div>',
		'before_title'  => '<p class="widget-title"><span>',
		'after_title'   => '</span></p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 1', 'nutmeg' ),
		'id'            => 'footer-col-1',
		'description'   => esc_html__( 'The first column of the widgetized grid. You can enable/disable these 5 columns on the Customize page, in the Theme Settings > Footer panel.', 'nutmeg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content-wrapper">',
		'after_widget'  => '</div><!-- .widget-content-wrapper --></div>',
		'before_title'  => '<p class="widget-title"><span>',
		'after_title'   => '</span></p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 2', 'nutmeg' ),
		'id'            => 'footer-col-2',
		'description'   => esc_html__( 'The second column of the widgetized grid.', 'nutmeg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content-wrapper">',
		'after_widget'  => '</div><!-- .widget-content-wrapper --></div>',
		'before_title'  => '<p class="widget-title"><span>',
		'after_title'   => '</span></p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 3', 'nutmeg' ),
		'id'            => 'footer-col-3',
		'description'   => esc_html__( 'The third column of the widgetized grid.', 'nutmeg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content-wrapper">',
		'after_widget'  => '</div><!-- .widget-content-wrapper --></div>',
		'before_title'  => '<p class="widget-title"><span>',
		'after_title'   => '</span></p>',
	) );

} 

add_action( 'widgets_init', 'nutmeg_widgetized_areas_init' );