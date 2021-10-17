<?php			

if ( ! isset( $content_width ) ) $content_width = 850;

/**
* Define some constats
*/

if( ! defined( 'ILOVEWP_VERSION' ) ) {
	define( 'ILOVEWP_VERSION', '1.0.4' );
}
if( ! defined( 'ILOVEWP_THEME_LITE' ) ) {
	define( 'ILOVEWP_THEME_LITE', true );
}
if( ! defined( 'ILOVEWP_THEME_PRO' ) ) {
	define( 'ILOVEWP_THEME_PRO', false );
}
if( ! defined( 'ILOVEWP_DIR' ) ) {
	define( 'ILOVEWP_DIR', trailingslashit( get_template_directory() ) );
}
if( ! defined( 'ILOVEWP_DIR_URI' ) ) {
	define( 'ILOVEWP_DIR_URI', trailingslashit( get_template_directory_uri() ) );
}

/* Disable PHP error reporting for notices, leave only the important ones 
================================== */

/**
* Theme functions and definitions
*
* Set up the theme and provides some helper functions, which are used in the
* theme as custom template tags. Others are attached to action and filter
* hooks in WordPress to change core functionality.
*
* When using a child theme you can override certain functions (those wrapped
* in a function_exists() call) by defining them first in your child theme's
* functions.php file. The child theme's functions.php file is included before
* the parent theme's file, so the child theme functions would be used.
*/

if ( ! function_exists( 'nutmeg_setup' ) ) :
	/**
	* Theme setup.
	*
	* Set up theme defaults and registers support for various WordPress features.
	*
	* Note that this function is hooked into the after_setup_theme hook, which
	* runs before the init hook. The init hook is too late for some features, such
	* as indicating support post thumbnails.
	*/
	function nutmeg_setup() {
	// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'css/editor-style.css' ) );

		/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 410, 410, array( 'center', 'center') );

		add_image_size( 'nutmeg-thumb-landscape-large', 850, 560, true );
		add_image_size( 'nutmeg-thumb-landscape', 410, 275, true );
		add_image_size( 'nutmeg-thumb-portrait', 410, 580, true );

		/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
		add_theme_support( 'html5', array(
			'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/* Add support for Custom Background 
		==================================== */

		// Custom background color.
		add_theme_support( 'custom-background', array(
			'default-color'	=> 'FFFFFF'
		) );

		/* Add support for Custom Logo 
		==================================== */

		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/* Add support for post and comment RSS feed links in <head>
		==================================== */

		add_theme_support( 'automatic-feed-links' ); 

		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

		/* Add support for Localization
		==================================== */

		/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Twenty Twenty, use a find and replace
		* to change 'twentytwenty' to the name of your theme in all the template files.
		*/
		load_theme_textdomain( 'nutmeg' );

		// Register nav menus
		register_nav_menus( array(
			'primary' 				=> __( 'Primary Menu - Header Layout Version 1', 'nutmeg' ),
			'mobile' 				=> __( 'Mobile Menu', 'nutmeg' ),
			'secondary' 			=> __( 'Secondary Menu', 'nutmeg' ),
			'footer'				=> __( 'Footer Menu', 'nutmeg' ),
			'primary-left' 			=> __( 'Primary Menu (Left) - Header Layout Version 2', 'nutmeg' ),
			'primary-right' 		=> __( 'Primary Menu (Right) - Header Layout Version 2', 'nutmeg' ),
		) );

		// Block Editor font sizes.
		add_theme_support( 'editor-font-sizes',
			array(
				array(
					'name'      => esc_html_x( 'Small', 'Name of the small font size in Gutenberg', 'nutmeg' ),
					'shortName' => esc_html_x( 'S', 'Short name of the small font size in the Gutenberg editor.', 'nutmeg' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html_x( 'Regular', 'Name of the regular font size in Gutenberg', 'nutmeg' ),
					'shortName' => esc_html_x( 'M', 'Short name of the regular font size in the Gutenberg editor.', 'nutmeg' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html_x( 'Large', 'Name of the large font size in Gutenberg', 'nutmeg' ),
					'shortName' => esc_html_x( 'L', 'Short name of the large font size in the Gutenberg editor.', 'nutmeg' ),
					'size'      => 22,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html_x( 'Larger', 'Name of the larger font size in Gutenberg', 'nutmeg' ),
					'shortName' => esc_html_x( 'XL', 'Short name of the larger font size in the Gutenberg editor.', 'nutmeg' ),
					'size'      => 26,
					'slug'      => 'larger',
				),
				array(
					'name'      => esc_html_x( 'Largest', 'Name of the larger font size in Gutenberg', 'nutmeg' ),
					'shortName' => esc_html_x( 'XXL', 'Short name of the larger font size in the Gutenberg editor.', 'nutmeg' ),
					'size'      => 36,
					'slug'      => 'largest',
				)
			)
		);
	}
endif;

add_action( 'after_setup_theme', 'nutmeg_setup' );

function nutmeg_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'nutmeg-thumb-landscape-large'	=> __( 'Featured Image: Landscape (850x560)', 'nutmeg' ),
		'nutmeg-thumb-landscape' 		=> __( 'Featured Image: Landscape (410x275)', 'nutmeg' ),
		'nutmeg-thumb-portrait' 		=> __( 'Featured Image: Portrait (410x580)', 'nutmeg' ),
		'post-thumbnail' 				=> __( 'Featured Image: Square (410x410)', 'nutmeg' )
	) );
}

add_filter( 'image_size_names_choose', 'nutmeg_custom_sizes' );

/* Add javascripts and CSS used by the theme 
================================== */

function nutmeg_js_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	// Theme stylesheet.
	wp_enqueue_style( 'nutmeg-style', get_stylesheet_uri() );

	if (! is_admin()) {

		wp_enqueue_script(
			'jquery-fitvids',
			get_template_directory_uri() . '/js/jquery.fitvids.js',
			array('jquery'),
			'1.7.10',
			true
		);

		wp_enqueue_script(
			'jquery-superfish',
			get_template_directory_uri() . '/js/superfish.min.js',
			array('jquery'),
			'1.7.10',
			true
		);

		wp_enqueue_script(
			'nutmeg-init',
			get_template_directory_uri() . '/js/nutmeg-init.js',
			array('jquery'),
			$theme_version, 
			true
		);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Font-Awesome */
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/fontawesome.all.min.css', null, '5.15.3');

	}

}
add_action('wp_enqueue_scripts', 'nutmeg_js_scripts');

function nutmeg_enqueue_fonts() {

	wp_enqueue_style(
		'nutmeg-fonts',
		'//fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Newsreader:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,700&display=swap',
		array(),
		'1.0'
	);

}

add_action( 'wp_enqueue_scripts', 'nutmeg_enqueue_fonts' );

/**
* Enqueue supplemental block editor styles.
*/

if ( ! function_exists( 'ilovewp_nutmeg_block_editor_styles' ) ) :
	function ilovewp_nutmeg_block_editor_styles() {

		$ILOVEWP_Customizer = new ILOVEWP_Customizer();

		wp_enqueue_style(
			'nutmeg-fonts',
			'//fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Newsreader:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,700&display=swap',
			array(),
			'1.0'
		);

		// Enqueue the editor styles.
		wp_enqueue_style( 'ilovewp_nutmeg_block_editor_styles', get_theme_file_uri( '/css/editor-style-block.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );

		// Add inline style from the Customizer.
		wp_add_inline_style( 'ilovewp_nutmeg_block_editor_styles', $ILOVEWP_Customizer->ilovewp_get_customization_css() );

	}
	add_action( 'enqueue_block_editor_assets', 'ilovewp_nutmeg_block_editor_styles', 1, 1 );
endif;

/* Custom Archives titles.
=================================== */

if ( ! function_exists( 'nutmeg_get_the_archive_title' ) ) :
	function nutmeg_get_the_archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		}

		return $title;
	}
endif;

add_filter( 'get_the_archive_title', 'nutmeg_get_the_archive_title' );

/* Enable Excerpts for Static Pages
==================================== */

add_action( 'init', 'nutmeg_excerpts_for_pages' );

function nutmeg_excerpts_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}

/* Custom Excerpt Length
==================================== */

function nutmeg_new_excerpt_length($length) {
	if ( is_admin() ) { return $length; }
	else { return 25; }
}
add_filter('excerpt_length', 'nutmeg_new_excerpt_length');

/* Replace invalid ellipsis from excerpts
==================================== */

function nutmeg_excerpts($text)
{
	if ( is_admin() ) return $text;
	$text = str_replace(' [&hellip;]', '&hellip;', $text);
	$text = str_replace('[&hellip;]', '&hellip;', $text);
	$text = str_replace('[...]', '...', $text);
	return $text;
}
add_filter('excerpt_more', 'nutmeg_excerpts');

/* Convert HEX color to RGB value (for the customizer)						
==================================== */

function nutmeg_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = "$r, $g, $b";
return $rgb; // returns an array with the rgb values
}

/**
* Add a pingback url auto-discovery header for singularly identifiable articles.
*/
function nutmeg_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo( 'pingback_url' )) );
	}
}
add_action( 'wp_head', 'nutmeg_pingback_header' );

/**
* --------------------------------------------
* Enqueue scripts and styles for the backend.
* --------------------------------------------
*/

if ( ! function_exists( 'nutmeg_scripts_admin' ) ) {
/**
* Enqueue admin styles and scripts
*
* @since  2.0.0
* @return void
*/
function nutmeg_scripts_admin( $hook ) {

	wp_enqueue_style(
		'nutmeg-style-admin',
		get_template_directory_uri() . '/ilovewp-admin/css/ilovewp_theme_settings.css',
		'', ILOVEWP_VERSION, 'all'
	);

}
}
add_action( 'admin_enqueue_scripts', 'nutmeg_scripts_admin' );

/**
* Adds custom classes to the array of body classes.
*
* @since Nutmeg 2.0
*
* @param array $classes Classes for the body element.
* @return array (Maybe) filtered body classes.
*/
function nutmeg_body_classes( $classes ) {

	$classes[] = ilovewp_helper_get_header_layout();
	$classes[] = ilovewp_helper_get_sidebar_position();
	$classes[] = ilovewp_helper_get_animations();

	return $classes;
}

add_filter( 'body_class', 'nutmeg_body_classes' );

if ( ! function_exists( 'nutmeg_the_custom_logo' ) ) {

/**
* Displays the optional custom logo.
*
* Does nothing if the custom logo is not available.
*
* @since Nutmeg 1.0
*/

function nutmeg_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {

// We don't use the default the_custom_logo() function because of its automatic addition of itemprop attributes (they fail the ARIA tests)

		$site = get_bloginfo('name');
		$custom_logo_id = get_theme_mod( 'custom_logo' );

		if ( $custom_logo_id ) {
			$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>', 
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image( $custom_logo_id, 'full', false, array(
					'class'    => 'custom-logo',
					'alt' => __('Logo for ', 'nutmeg') . esc_attr($site),
				) )
			);
		}

		echo $html;

	}

}
}

if ( ! function_exists( 'nutmeg_comment' ) ) :
/**
* Template for comments and pingbacks.
* Used as a callback by wp_list_comments() for displaying the comments.
*/
function nutmeg_comment( $comment, $args, $depth ) {

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'nutmeg' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'nutmeg' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

			<?php else : ?>

				<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
					<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

						<div class="comment-author vcard">
							<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						</div><!-- .comment-author -->

						<header class="comment-meta">
							<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>

							<div class="comment-metadata">
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
									<time datetime="<?php comment_time( 'c' ); ?>">
										<?php /* translators: 1: date, 2: time */ printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'nutmeg' ), get_comment_date(), get_comment_time() ); ?>
									</time>
								</a>
							</div><!-- .comment-metadata -->

							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'nutmeg' ); ?></p>
							<?php endif; ?>

							<div class="comment-tools">
								<?php edit_comment_link( esc_html__( 'Edit', 'nutmeg' ), '<span class="edit-link">', '</span>' ); ?>

								<?php
								comment_reply_link( array_merge( $args, array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<span class="reply">',
									'after'     => '</span>',
								) ) );
								?>
							</div><!-- .comment-tools -->
						</header><!-- .comment-meta -->

						<div class="comment-content">
							<?php comment_text(); ?>
						</div><!-- .comment-content -->
					</article><!-- .comment-body -->

					<?php
				endif;
			}
endif; // ends check for nutmeg_comment()

if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function nutmeg_remove_header_textcolor( $wp_customize ) {

// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );
	return $wp_customize;

}
add_action( 'customize_register', 'nutmeg_remove_header_textcolor' );

/* Include WordPress Theme Customizer
================================== */

require_once( get_template_directory() . '/ilovewp-admin/customizer/customizer.php');

/* Include Additional Options and Components
================================== */

require_once( get_template_directory() . '/ilovewp-admin/helper-functions.php');
require_once( get_template_directory() . '/ilovewp-admin/sidebars.php');

require_once( get_template_directory() . '/ilovewp-admin/components/class-nutmeg-blocks-manager.php');

if ( ! function_exists( 'nutmeg_register_widgets' ) ) :
	function nutmeg_register_widgets() {

		require_once( get_template_directory() . '/ilovewp-admin/widgets/posts-section.php');

// Register custom widgets
		register_widget( 'nutmeg_widget_posts_section' );

	}
	add_action( 'widgets_init', 'nutmeg_register_widgets' );
endif;

/* Include Theme Options Page for Admin
================================== */

//require only in admin!
if ( is_admin() ) {	

	require_once('ilovewp-admin/ilovewp-theme-settings.php');

	if (current_user_can( 'manage_options' ) ) {
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notices.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-welcome.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-upgrade.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-review.php');

		// Remove theme data from database when theme is deactivated.
		add_action('switch_theme', 'nutmeg_db_data_remove');

		if ( ! function_exists( 'nutmeg_db_data_remove' ) ) {
			function nutmeg_db_data_remove() {

				delete_option( 'nutmeg_admin_notices');
				delete_option( 'nutmeg_theme_installed_time');

			}
		}

	}

}