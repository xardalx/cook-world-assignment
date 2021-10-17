<?php

function ilovewp_customizer_define_general_sections( $sections ) {
	$panel           = 'ilovewp' . '_general';
	$general_sections = array();

	$theme_header_layout = array(
		'1' 		=> esc_html__('Version 1', 'nutmeg'),
		'2' 		=> esc_html__('Version 2', 'nutmeg'),
		'3' 		=> esc_html__('Version 3', 'nutmeg')
	);

	$theme_loop_layout = array(
		'list-even-columns' 	=> esc_html__('List - 50/50','nutmeg'),
		'list-fullwidth'     	=> esc_html__('List - Full Width','nutmeg'),
		'columns-2'    	=> esc_html__('Columns - 2 columns','nutmeg'),
		'columns-3' 	=> esc_html__('Columns - 3 columns','nutmeg'),
		'columns-4' 	=> esc_html__('Columns - 4 columns','nutmeg')
	);

	$theme_loop_style = array(
		'standard' 	=> esc_html__('Standard','nutmeg'),
		'card'     	=> esc_html__('Card','nutmeg')
	);

	$theme_loop_thumbnail = array(
		'nutmeg-thumb-landscape' 		=> esc_html__('Landscape','nutmeg'),
		'post-thumbnail' 		    	=> esc_html__('Square','nutmeg'),
		'nutmeg-thumb-portrait'     	=> esc_html__('Portrait','nutmeg')
	);

	$theme_sidebar_positions = array(
		'left'      	=> esc_html__('Left','nutmeg'),
		'right'     	=> esc_html__('Right','nutmeg'),
		'nosidebar' 	=> esc_html__('No Sidebar','nutmeg')
	);

	$theme_single_featured_image_position = array(
		'hidden'           => esc_html__('Hidden','nutmeg'),
		'fullwidth'        => esc_html__('Full Width','nutmeg'),
		'float-left'       => esc_html__('Floated to the left','nutmeg'),
		'float-right'      => esc_html__('Floated to the right','nutmeg')
	);

	$theme_footer_columns = array(
		'0' => esc_html__('Hidden', 'nutmeg'),
		'1' => esc_html__('1 Column', 'nutmeg'),
		'2' => esc_html__('2 Columns', 'nutmeg'),
		'3' => esc_html__('3 Columns', 'nutmeg'),
		'4' => esc_html__('4 Columns', 'nutmeg'),
		'5' => esc_html__('5 Columns', 'nutmeg')
	);

	$theme_default = array('default' => 'Theme Default');

    $theme_numbers = array('0','1','2','3','4','5','6','7','8','9','10','11','12');

    $general_sections['general'] = array(
        'panel'     => $panel,
        'title'     => esc_html__( 'General Options', 'nutmeg' ),
        'priority'  => 4900,
        'options'   => array(

            'theme-nutmeg-sidebar-position'     => array(
                'setting' 				=> array(
                    'default' 			=> 'right',
                    'sanitize_callback' => 'ilovewp_sanitize_text'
                ),
                'control' 				=> array(
                    'label' 			=> esc_html__( 'Default Sidebar Position','nutmeg' ),
                    'description'       => esc_html__( 'This setting can be manually overwritten on specific pages and posts.', 'nutmeg' ),
                    'type'  			=> 'select',
                    'choices' 			=> $theme_sidebar_positions
                ),
            ),

            'theme-nutmeg-transform-animation-thumbnails' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Enable Transform Animations', 'nutmeg' ),
                    'description'       => esc_html__( 'Check this if you want to have a zoom effect when hovering over post thumbnails.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-display-comments-posts' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Comments for Posts', 'nutmeg' ),
                    'description'       => esc_html__( 'Check this if you want to accept and display comments in blog posts.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-display-comments-pages' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Comments for Pages', 'nutmeg' ),
                    'description'       => esc_html__( 'Check this if you want to accept and display comments in pages.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

        ),
    );

    $general_sections['header'] = array(
        'panel'     => $panel,
        'title'     => esc_html__( 'Header', 'nutmeg' ),
        'priority'  => 4900,
        'options'   => array(

            'theme-nutmeg-header-layout'     => array(
                'setting' 					=> array(
                    'default' 				=> '1',
                    'sanitize_callback' 	=> 'ilovewp_sanitize_text'
                ),
                'control' 					=> array(
                    'label' 				=> esc_html__( 'Header Layout','nutmeg' ),
                    'description'       	=> esc_html__( 'Choose the layout for the header: logo and widgetized area.', 'nutmeg' ),
                    'type'  				=> 'select',
                    'choices' 				=> $theme_header_layout
                ),
            ),

            'theme-nutmeg-display-premasthead' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Top Bar in Header', 'nutmeg' ),
                    'description'       => esc_html__( 'Check this if you want to display the secondary menu and/or some text in the header, above the logo.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-string-header' => array(
                'setting'               => array(
                    'sanitize_callback' => 'ilovewp_sanitize_text',
                    'default'           => esc_html__( 'Nutmeg is a powerful WordPress theme.', 'nutmeg' ),
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Text in the header above the logo', 'nutmeg' ),
                    'type'              => 'textarea',
                ),
            ),

            'theme-nutmeg-display-header-searchform' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Search Form in Header', 'nutmeg' ),
                    'description'       => esc_html__( 'Check this if you want to display the search icon in the header.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

        ),
    );

    $general_sections['homepage'] = array(
        'panel'     => $panel,
        'title'     => esc_html__( 'Homepage', 'nutmeg' ),
        'description' => esc_html__( 'Some of these settings will be used only when the homepage is set to display a static page, and that page is set to use the Homepage custom page template.', 'nutmeg' ),
        'priority'  => 4900,
        'options'   => array(

            'theme-nutmeg-string-recent-posts' => array(
                'setting'               => array(
                    'sanitize_callback' => 'ilovewp_sanitize_text',
                    'default'           => esc_html__( 'Newest Recipes', 'nutmeg' ),
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Recent Posts section title on the homepage', 'nutmeg' ),
                    'type'              => 'text',
                ),
            ),

            'theme-nutmeg-recent-posts-category'     => array(
                'setting'                   => array(
                    'default'               => 'none',
                    'sanitize_callback'     => 'nutmeg_sanitize_categories'
                ),
                'control'                   => array(
                    'label'                 => esc_html__( 'Posts Category','nutmeg' ),
                    'description'           => esc_html__( 'Display posts only from a single category.', 'nutmeg' ),
                    'type'                  => 'select',
                    'choices'               => nutmeg_get_categories()
                ),
            ),

            'theme-nutmeg-recent-posts-num' => array(
                'setting'               => array(
                    'sanitize_callback' => 'ilovewp_sanitize_text',
                    'default'           => '4',
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Number of Posts','nutmeg' ),
                    'description'       => esc_html__( 'The amount of posts to display on the homepage.', 'nutmeg' ),
                    'type'              => 'number',
                ),
            ),

            'theme-nutmeg-display-homepage-bloglink' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Blog Link', 'nutmeg' ),
                    'description'       => esc_html__( 'Check this if you want to display a link to the Blog page.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-string-bloglink' => array(
                'setting' 				=> array(
                    'default'           => esc_html__('View More Recipes','nutmeg'),
                    'sanitize_callback' => 'sanitize_text_field',
                ),
                'control' 				=> array(
                    'label'             => esc_html__( 'Link text', 'nutmeg' ),
                    'type'              => 'text',
                ),
            ),

        ),
    );

    $general_sections['posts-archives'] = array(
        'panel'     => $panel,
        'title'     => esc_html__( 'Post Archives', 'nutmeg' ),
        'priority'  => 4900,
        'options'   => array(

            'theme-nutmeg-archives-layout'     => array(
                'setting'                   => array(
                    'default'               => 'columns-2',
                    'sanitize_callback'     => 'ilovewp_sanitize_text'
                ),
                'control'                   => array(
                    'label'                 => esc_html__( 'Post Archives Layout','nutmeg' ),
                    'description'           => esc_html__( 'Choose the layout for all archive pages that display posts.', 'nutmeg' ),
                    'type'                  => 'select',
                    'choices'               => $theme_loop_layout
                ),
            ),

            'theme-nutmeg-archives-style'     => array(
                'setting'                   => array(
                    'default'               => 'standard',
                    'sanitize_callback'     => 'ilovewp_sanitize_text'
                ),
                'control'                   => array(
                    'label'                 => esc_html__( 'Post Archives Style','nutmeg' ),
                    'description'           => esc_html__( 'Choose the style for all archive pages that display posts.', 'nutmeg' ),
                    'type'                  => 'select',
                    'choices'               => $theme_loop_style
                ),
            ),

            'theme-nutmeg-archives-display-thumbnail' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Featured Image', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the featured image of a post on archive pages.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-archives-thumbnail-size'     => array(
                'setting'                   => array(
                    'default'               => 'nutmeg-thumb-landscape',
                    'sanitize_callback'     => 'ilovewp_sanitize_text'
                ),
                'control'                   => array(
                    'label'                 => esc_html__( 'Post Thumbnail Size','nutmeg' ),
                    'description'           => esc_html__( 'Choose the thumbnail size for your posts.', 'nutmeg' ),
                    'type'                  => 'select',
                    'choices'               => $theme_loop_thumbnail
                ),
            ),

            'theme-nutmeg-archives-display-date' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Date', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the published date of a post on archive pages.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-archives-display-category' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Category', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the category/categories of a post on archive pages.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-archives-display-excerpt' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Excerpt', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the excerpt of a post on archive pages.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-archives-display-author' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Author', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the author of a post.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-archives-display-author_withdate' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Date after Author', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the post date below the author name.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-archives-display-readmore' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Read More Link', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the View Recipe link under the excerpt of a post.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-string-readmore' => array(
                'setting' 				=> array(
                    'default'           => esc_html__('View Recipe','nutmeg'),
                    'sanitize_callback' => 'sanitize_text_field',
                ),
                'control' 				=> array(
                    'label'             => esc_html__( 'Link text', 'nutmeg' ),
                    'type'              => 'text',
                ),
            ),

        ),
    );

    $general_sections['posts-single'] = array(
        'panel'     => $panel,
        'title'     => esc_html__( 'Single Posts', 'nutmeg' ),
        'priority'  => 4900,
        'options'   => array(

            'theme-nutmeg-single-thumbnail-position'     => array(
                'setting'                   => array(
                    'default'               => 'fullwidth',
                    'sanitize_callback'     => 'ilovewp_sanitize_text'
                ),
                'control'                   => array(
                    'label'                 => esc_html__( 'Featured Image Position','nutmeg' ),
                    'description'           => esc_html__( 'Choose the location and size of the featured thumbnail.', 'nutmeg' ),
                    'type'                  => 'select',
                    'choices'               => $theme_single_featured_image_position
                ),
            ),

            'theme-nutmeg-single-display-date' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Date', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the published date.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-single-display-category' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Category', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the category/categories.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-single-display-tags' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Tags', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the post tags.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-single-display-post-navigation' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Post Navigation', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the older/newer links after the post content.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-single-display-post-navigation-thumbnails' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 1
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Post Navigation Thumbnails', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display post thumbnails in the Post Navigation section.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-single-display-author-bio' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Author Bio', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display information about the author at the end of the post.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

            'theme-nutmeg-single-display-author-social' => array(
                'setting'               => array(
                    'sanitize_callback' => 'absint',
                    'default'           => 0
                ),
                'control'               => array(
                    'label'             => esc_html__( 'Display Author Social Media Links', 'nutmeg' ),
                    'description'       => esc_html__( 'This will display the social media links from an author\'s profile.', 'nutmeg' ),
                    'type'              => 'checkbox'
                )
            ),

        ),
    );

    $general_sections['footer'] = array(
        'panel'     => $panel,
        'title'     => esc_html__( 'Footer', 'nutmeg' ),
        'priority'  => 4900,
        'options'   => array(

            'theme-nutmeg-footer-columns' => array(
                'setting' => array(
                    'default'           => '3',
                    'sanitize_callback' => 'ilovewp_sanitize_text'
                ),
                'control'                   => array(
                    'label'             => esc_html__( 'Number of Widgetized Columns in Footer', 'nutmeg' ),
                    'type'              => 'radio',
                    'choices'           => $theme_footer_columns
                ),
            ),

            'theme-nutmeg-footer-text' => array(
                'setting' 					=> array(
                    'sanitize_callback' 	=> 'ilovewp_sanitize_text',
                ),
                'control' => array(
                    'label'             	=> esc_html__( 'Copyright Text', 'nutmeg' ),
                    'type'              	=> 'text',
                ),
            ),

        ),
    );

    $general_sections['labels'] = array(
        'panel'     => $panel,
        'title'     => esc_html__( 'Text Labels', 'nutmeg' ),
        'priority'  => 4900,
        'options'   => array(

            'theme-nutmeg-string-open-menu' => array(
                'setting' 				=> array(
                    'sanitize_callback' => 'ilovewp_sanitize_text',
                    'default'           => esc_html__( 'Menu', 'nutmeg' ),
                ),
                'control' 				=> array(
                    'label'             => esc_html__( 'Open menu button label', 'nutmeg' ),
                    'type'              => 'text',
                ),
            ),

            'theme-nutmeg-string-close-menu' => array(
                'setting' 				=> array(
                    'sanitize_callback' => 'ilovewp_sanitize_text',
                    'default'           => esc_html__( 'Menu', 'nutmeg' ),
                ),
                'control' 				=> array(
                    'label'             => esc_html__( 'Close menu button label', 'nutmeg' ),
                    'type'              => 'text',
                ),
            )

        ),
    );

    return array_merge( $sections, $general_sections );
}

add_filter( 'ilovewp_customizer_sections', 'ilovewp_customizer_define_general_sections' );