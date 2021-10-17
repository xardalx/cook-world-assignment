<?php

if( ! function_exists( 'ilovewp_helper_display_breadcrumbs' ) ) {
	function ilovewp_helper_display_breadcrumbs() {

		global $post;

		if ( is_home() || is_front_page() ) {
			return;
		}
		
		// CONDITIONAL FOR "Breadcrumb NavXT" plugin OR Yoast SEO Breadcrumbs
		// https://wordpress.org/plugins/breadcrumb-navxt/

		if ( function_exists('bcn_display') ) { ?>
		<div class="site-breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			<p class="site-breadcrumbs-p"><?php bcn_display(); ?></p>
		</div><!-- .site-breadcrumbs--><?php }

		// CONDITIONAL FOR "Yoast SEO" plugin, Breadcrumbs feature
		// https://wordpress.org/plugins/wordpress-seo/
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div class="site-breadcrumbs"><p class="site-breadcrumbs-p">','</p></div>');
		}

	}
}

if( ! function_exists( 'ilovewp_helper_display_title' ) ) {
	function ilovewp_helper_display_title($post) {

		if ( ! is_object( $post ) ) return;

		the_title( '<h1 class="page-title"><span class="page-title-span">', '</span></h1>' );
	}
}

if( ! function_exists( 'ilovewp_helper_display_datetime' ) ) {
	function ilovewp_helper_display_datetime($post) {
		
		if ( ! is_object( $post ) ) return;

		return '<p class="entry-descriptor"><span class="entry-descriptor-span"><time class="entry-date published" datetime="' . esc_attr(get_the_date('c')) . '">' . get_the_date() . '</time></span></p>';
	}
}

if( ! function_exists( 'ilovewp_helper_display_excerpt' ) ) {
	function ilovewp_helper_display_excerpt($post) {

		if ( ! is_object( $post ) ) return;
		?><div class="entry-excerpt"><?php the_excerpt(); ?></div><?php

	}
}

if( ! function_exists( 'ilovewp_helper_display_readmore' ) ) {
	function ilovewp_helper_display_readmore($post) {

		if ( ! is_object( $post ) ) return;
		if ( get_post_type($post->ID) != 'post' && get_post_type($post->ID) != 'recipe' ) { return; }

		return '<span class="site-cta-span"><a href="' . esc_url( get_permalink($post) ) . '" class="site-cta-anchor">' . esc_html(get_theme_mod( 'theme-nutmeg-string-readmore', __('View Recipe', 'nutmeg') )) . '</a></span>';

	}
}

if( ! function_exists( 'ilovewp_helper_display_comments' ) ) {
	function ilovewp_helper_display_comments($post) {

		if ( ! is_object( $post ) ) return;

		if ( is_page() ) {
			$themeoptions_display_comments_pages = get_theme_mod( 'theme-nutmeg-display-comments-pages', 1 );
			if ( $themeoptions_display_comments_pages == 0 ) {
				return;
			}
		}

		if ( is_single() ) {
			$themeoptions_display_comments_posts = get_theme_mod( 'theme-nutmeg-display-comments-posts', 1 );
			if ( $themeoptions_display_comments_posts == 0 ) {
				return;
			}
		}

		if ( comments_open() || get_comments_number() ) :

			comments_template();

		endif;

	}
}

if( ! function_exists( 'ilovewp_helper_display_content' ) ) {
	function ilovewp_helper_display_content($post) {

		if ( ! is_object( $post ) ) return;

		echo '<div class="entry-content">';
			
			ilovewp_helper_display_featured_image_floated($post);

			the_content();
			
			wp_link_pages(array('before' => '<p class="page-navigation"><strong>'.__('Pages', 'nutmeg').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));

		echo '</div><!-- .entry-content -->';

	}
}

if( ! function_exists( 'ilovewp_helper_display_tags' ) ) {
	function ilovewp_helper_display_tags() {

		global $post;
		if ( ! is_object( $post ) ) return;
		if ( get_post_type($post->ID) != 'post' ) return;

		$themeoptions_display_tags = get_theme_mod( 'theme-nutmeg-single-display-tags', 1 );
		if ( $themeoptions_display_tags == 0 ) {
			return;
		}

		if ( get_post_type($post->ID) == 'post' ) { 
			the_tags( '<p class="post-meta-tags"><span class="post-navigation-label">'.__('Tagged with', 'nutmeg').':</span> ', '', '</p>');
		}

	}
}

// Post Next/Previous navigation
if( ! function_exists( 'ilovewp_helper_display_post_navigation' ) ) {
	function ilovewp_helper_display_post_navigation() {

		global $post;
		if ( ! is_object( $post ) ) return;
		if ( get_post_type($post->ID) != 'post' ) return;

		$themeoptions_display_postnav = get_theme_mod( 'theme-nutmeg-single-display-post-navigation', 1 );
		if ( $themeoptions_display_postnav == 0 ) {
			return;
		}

		$themeoptions_display_postnav_thumbs = get_theme_mod( 'theme-nutmeg-single-display-post-navigation-thumbnails', 1 );

		$prev_post = get_adjacent_post(false, '', true);
		$next_post = get_adjacent_post(false, '', false);

		$output = '';
		$output .= '<div class="ht-site-flex site-post-navigation">';
		$output .= '<div class="ht-site-cell site-post-nav-item site-post-nav-prev">';
		if ( is_object( $prev_post ) && $prev_post->ID != $post->ID ) {

			$output .= '<p class="widget-title">' . __('Previous Post', 'nutmeg') . '</p>';

			if ( $themeoptions_display_postnav_thumbs == 1 && has_post_thumbnail($prev_post) ) {
				$output .= '<div class="entry-thumbnail"><div class="entry-thumbnail-wrapper">'; 
				$output .= '<a href="' . esc_url( get_permalink($prev_post) ) . '">';
				$output .= get_the_post_thumbnail($prev_post, 'post-thumbnail');
				$output .= '</a>';
				$output .= '</div><!-- .entry-thumbnail-wrapper --></div><!-- .entry-thumbnail -->';
			}

			$output .= '<h3 class="entry-title"><a href="' . esc_url(get_page_link($prev_post)) . '">' . esc_html(get_the_title($prev_post)) . '</a></h3>';

		}
		$output .= '</div><!-- .site-post-nav-item -->';
		
		$output .= '<div class="ht-site-cell site-post-nav-item site-post-nav-next">'; 
		if ( is_object( $next_post ) && $next_post->ID != $post->ID ) {

			$output .= '<p class="widget-title">' . __('Next Post', 'nutmeg') . '</p>';

			if ( $themeoptions_display_postnav_thumbs == 1 && has_post_thumbnail($next_post) ) {
				$output .= '<div class="entry-thumbnail"><div class="entry-thumbnail-wrapper">'; 
				$output .= '<a href="' . esc_url( get_permalink($next_post) ) . '">';
				$output .= get_the_post_thumbnail($next_post, 'post-thumbnail');
				$output .= '</a>';
				$output .= '</div><!-- .entry-thumbnail-wrapper --></div><!-- .entry-thumbnail -->';
			}

			$output .= '<h3 class="entry-title"><a href="' . esc_url(get_page_link($next_post)) . '">' . esc_html(get_the_title($next_post)) . '</a></h3>';

		}
		$output .= '</div><!-- .site-post-nav-item -->';
		$output .= '</div><!-- .site-post-navigation -->';

		echo $output;

	}
}

if( ! function_exists( 'ilovewp_helper_display_after_content' ) ) {
	function ilovewp_helper_display_after_content() {

		global $post;
		if ( ! is_object( $post ) ) return;
		if ( get_post_type($post->ID) != 'post' ) return;

		ob_start();
		ilovewp_helper_display_tags();
		ilovewp_helper_display_post_navigation();
		$output = ob_get_contents();
		ob_end_clean();

		if ( strlen($output) > 0 ) {
			echo '<div class="entry-extra-box entry-after-content-meta js-scroll fade-in-bottom">';
			echo $output;
			echo '</div><!-- .entry-extra-box entry-after-content-meta -->';
		}

	}
}

if( ! function_exists( 'ilovewp_helper_display_postmeta_single' ) ) {
	function ilovewp_helper_display_postmeta_single($post) {

		if ( ! is_object( $post ) ) return;

		if ( get_post_type($post->ID) == 'post' ) { 

			$themeoptions_display_post_published 	= get_theme_mod( 'theme-nutmeg-single-display-date', 1 );
			$themeoptions_display_post_category 	= get_theme_mod( 'theme-nutmeg-single-display-category', 1 );

			if ( $themeoptions_display_post_published == 0 && $themeoptions_display_post_category == 0 ) {
				return;
			}

			echo '<p class="entry-meta entry-meta-inner">';
			
			if ( $themeoptions_display_post_published == 1 ) { 
				echo '<span class="post-meta-span post-meta-span-time"><time datetime="' . esc_attr(get_the_time("Y-m-d")) . '" pubdate>' . esc_html(get_the_time(get_option('date_format'))) . '</time></span>';
			}
			if ( $themeoptions_display_post_category == 1 ) { 
				echo '<span class="post-meta-span post-meta-span-category">'; the_category(', '); echo '</span>';
			}
			echo '</p><!-- .entry-meta -->';

		}

	}
}

if( ! function_exists( 'ilovewp_helper_display_postmeta_archives' ) ) {
	function ilovewp_helper_display_postmeta_archives($post) {

		global $post;

		if ( ! is_object( $post ) ) return;

		if ( get_post_type($post->ID) == 'post' ) { 

			$themeoptions_display_post_published 	= get_theme_mod( 'theme-nutmeg-archives-display-date', 1 );
			$themeoptions_display_post_category 	= get_theme_mod( 'theme-nutmeg-archives-display-category', 1 );

			if ( $themeoptions_display_post_published == 0 && $themeoptions_display_post_category == 0 ) {
				return;
			}

			echo '<p class="entry-meta">';
			
			if ( $themeoptions_display_post_published == 1 ) { 
				echo '<span class="post-meta-span post-meta-span-time"><time datetime="' . esc_attr(get_the_time("Y-m-d")) . '" pubdate>' . esc_html(get_the_time(get_option('date_format'))) . '</time></span>';
			}
			if ( $themeoptions_display_post_category == 1 ) { 

				echo '<span class="post-meta-span post-meta-span-category">'; the_category(', '); echo '</span>';

			}
			echo '</p><!-- .entry-meta -->';

		}

	}
}

if( ! function_exists( 'ilovewp_helper_display_postauthor_archives' ) ) {
	function ilovewp_helper_display_postauthor_archives($post) {

		global $post;

		if ( ! is_object( $post ) ) return;

		if ( get_post_type($post->ID) == 'post' || get_post_type($post->ID) == 'recipe' ) { 

			$themeoptions_display_post_author = get_theme_mod( 'theme-nutmeg-archives-display-author', 0 );
			$themeoptions_display_post_author_withdate = get_theme_mod( 'theme-nutmeg-archives-display-author_withdate', 0 );

			if ( $themeoptions_display_post_author == 0 ) {
				return;
			}

			?><p class="entry-meta entry-meta-author">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), '32' ); ?>
			<span><?php echo esc_html('By','nutmeg'); ?> <?php echo esc_url( the_author_posts_link() ); ?><?php
			if ( $themeoptions_display_post_author_withdate == 1 ) {
				?><br><?php echo '<time datetime="' . esc_attr(get_the_time("Y-m-d")) . '" pubdate>' . esc_html(get_the_time(get_option('date_format'))) . '</time>'; ?><?php
			}
			?></span></p><!-- .entry-meta --><?php

		}

	}
}

// Post Author Box
if( ! function_exists( 'ilovewp_helper_display_authorbio' ) ) {
	function ilovewp_helper_display_authorbio($post) {

		global $post;
		if ( ! is_object( $post ) ) return;
		if ( get_post_type($post->ID) != 'post' ) return;

		$themeoptions_display_authorbio = get_theme_mod( 'theme-nutmeg-single-display-author-bio', 0 );
		$themeoptions_display_author_socialmedia = get_theme_mod( 'theme-nutmeg-single-display-author-social', 0 );

		if ( $themeoptions_display_authorbio == 0 ) {
			return;
		}

		if ( $themeoptions_display_author_socialmedia == 1 ) {
			$social_profiles = array();
			if ( get_the_author_meta( 'facebook_url' ) ) {
				$social_profiles['facebook'] = get_the_author_meta( 'facebook_url' );
			}
			if ( get_the_author_meta( 'aioseo_facebook' ) ) {
				$social_profiles['facebook'] = get_the_author_meta( 'aioseo_facebook' );
			}
			if ( get_the_author_meta( 'facebook' ) ) {
				$social_profiles['facebook'] = get_the_author_meta( 'facebook' );
			}
			if ( get_the_author_meta( 'twitter' ) ) {
				if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
					$social_profiles['twitter'] = 'https://twitter.com/' . get_the_author_meta( 'twitter' );
				}
			}
			if ( get_the_author_meta( 'aioseo_twitter' ) ) {
				$social_profiles['twitter'] = get_the_author_meta( 'aioseo_twitter' );
			}
			if ( get_the_author_meta( 'youtube' ) ) {
				$social_profiles['youtube'] = get_the_author_meta( 'youtube' );
			}
			if ( get_the_author_meta( 'instagram_url' ) ) {
				$social_profiles['instagram'] = get_the_author_meta( 'instagram_url' );
			}
			if ( get_the_author_meta( 'instagram' ) ) {
				$social_profiles['instagram'] = get_the_author_meta( 'instagram' );
			}
		}
		?>

		<div class="entry-extra-box entry-authorbio-wrapper js-scroll fade-in-bottom">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), '100' ); ?>
			<div class="author-description">
				<h3 class="author-name"><?php the_author_posts_link(); ?></h3>
				<div class="author-bio"><?php echo nl2br(get_the_author_meta('description')); ?></div>
				<?php if ( $themeoptions_display_author_socialmedia == 1 && count($social_profiles) > 0 ) { ?><div class="author-links"><?php
				if ( isset($social_profiles['facebook']) ) {
					echo '<span><i class="fab fa-facebook-square"></i><a href="' . esc_url($social_profiles['facebook']) . '" target="_blank" rel="external nofollow noopener">' . esc_html('Facebook', 'nutmeg') . '</span></a> ';
				}
				if ( isset($social_profiles['twitter']) ) {
					echo '<span><i class="fab fa-twitter-square"></i><a href="' . esc_url($social_profiles['twitter']) . '" target="_blank" rel="external nofollow noopener">' . esc_html('Twitter', 'nutmeg') . '</a></span> ';
				}
				if ( isset($social_profiles['instagram']) ) {
					echo '<span><i class="fab fa-instagram-square"></i><a href="' . esc_url($social_profiles['instagram']) . '" target="_blank" rel="external nofollow noopener">' . esc_html('Instagram', 'nutmeg') . '</a></span> ';
				}
				if ( isset($social_profiles['youtube']) ) {
					echo '<span><i class="fab fa-youtube"></i><a href="' . esc_url($social_profiles['youtube']) . '" target="_blank" rel="external nofollow noopener">' . esc_html('Youtube', 'nutmeg') . '</a></span> ';
				}
				?></div><?php } ?>
			</div><!-- .author-description -->
		</div><!-- .entry-extra-box .entry-authorbio-wrapper --><?php

	}
}

// Flex Wrapper Start
if( ! function_exists( 'ilovewp_helper_display_container_wrapper_start' ) ) {
	function ilovewp_helper_display_container_wrapper_start() {

		?><div id="site-main"><div class="site-section-wrapper"><?php

	}
}

// Flex Wrapper End
if( ! function_exists( 'ilovewp_helper_display_container_wrapper_end' ) ) {
	function ilovewp_helper_display_container_wrapper_end() {

		?></div><!-- .site-section-wrapper --></div><!-- #site-main --><?php

	}
}

// Flex Wrapper Start
if( ! function_exists( 'ilovewp_helper_display_flex_wrapper_start' ) ) {
	function ilovewp_helper_display_flex_wrapper_start() {

		?><div id="site-content-columns" class="ht-site-flex"><?php

	}
}

// Flex Wrapper End
if( ! function_exists( 'ilovewp_helper_display_flex_wrapper_end' ) ) {
	function ilovewp_helper_display_flex_wrapper_end() {

		?></div><!-- #site-content-columns .ht-site-flex --><?php

	}
}

// Content Column Wrapper Start
if( ! function_exists( 'ilovewp_helper_display_page_wrapper_start' ) ) {
	function ilovewp_helper_display_page_wrapper_start() {

		?><div id="site-content-column" class="ht-site-cell"><div class="site-column-wrapper"><?php

	}
}

// Content Column Wrapper End
if( ! function_exists( 'ilovewp_helper_display_page_wrapper_end' ) ) {
	function ilovewp_helper_display_page_wrapper_end() {

		?></div><!-- .site-column-wrapper --></div><!-- #site-content-column .ht-site-cell --><?php

	}
}

// Page Intro Column Wrapper Start
if( ! function_exists( 'ilovewp_helper_display_page_intro_wrapper_start' ) ) {
	function ilovewp_helper_display_page_intro_wrapper_start() {

		?><div class="page-intro-wrapper"><?php

	}
}

// Content Column Wrapper End
if( ! function_exists( 'ilovewp_helper_display_page_intro_wrapper_end' ) ) {
	function ilovewp_helper_display_page_intro_wrapper_end() {

		?></div><!-- .page-intro-wrapper --><?php

	}
}

if( ! function_exists( 'ilovewp_helper_display_featured_image' ) ) {
	function ilovewp_helper_display_featured_image() {

		if ( ( is_single() || is_page() ) ) {

			global $post;

			$themeoptions_thumbnail_position = get_theme_mod( 'theme-nutmeg-single-thumbnail-position', 'fullwidth' );

			// Bail out if featured images are not enabled in theme settings
			if ( $themeoptions_thumbnail_position != 'fullwidth' ) {
				return;
			}

			if ( has_post_thumbnail() ) {
				echo '<div class="entry-thumbnail entry-inner-thumbnail"><div class="entry-thumbnail-wrapper">';
				the_post_thumbnail('nutmeg-thumb-landscape-large');
				echo '</div><!-- .entry-thumbnail-wrapper --></div><!-- .entry-thumbnail .entry-inner-thumbnail -->';
			}

		}

	}
}

if( ! function_exists( 'ilovewp_helper_display_featured_image_floated' ) ) {
	function ilovewp_helper_display_featured_image_floated() {

		if ( (is_single() || is_page()) ) {

			global $post;

			$container_class = '';
			$themeoptions_thumbnail_position = get_theme_mod( 'theme-nutmeg-single-thumbnail-position', 'fullwidth' );

			// Bail out if featured images are not enabled in theme settings
			if ( $themeoptions_thumbnail_position != 'float-left' && $themeoptions_thumbnail_position != 'float-right' ) {
				return;
			}

			if ( strlen($container_class) == 0 ) {
				if ( $themeoptions_thumbnail_position == 'float-left' ) {
					$container_class = 'left';
				} elseif ( $themeoptions_thumbnail_position == 'float-right' ) {
					$container_class = 'right';
				}
			}
			
			if ( has_post_thumbnail() ) {
				echo '<div class="entry-thumbnail entry-thumbnail--inside entry-thumbnail--inside-' . $container_class . '"><div class="entry-thumbnail-wrapper">';
				the_post_thumbnail('nutmeg-thumb-portrait');
				echo '</div><!-- .entry-thumbnail-wrapper --></div><!-- .entry-inner-thumbnail -->';
			}

		}

	}
}

// Get Sidebar Position for Current Page or Post
if( ! function_exists( 'ilovewp_helper_get_sidebar_position' ) ) {
	function ilovewp_helper_get_sidebar_position() {

		global $post;

		$themeoptions_sidebar_position = get_theme_mod( 'theme-nutmeg-sidebar-position', 'right' );

		if ( $themeoptions_sidebar_position == 'left' ) {
			$default_position = 'page-withsidebar--left';
		} elseif ( $themeoptions_sidebar_position == 'right' ) {
			$default_position = 'page-withsidebar--right';
		} else {
			$default_position = 'page-withoutsidebar';
		}

		if ( is_singular() || is_front_page() ) {

			if ( isset($post) ) {
				$meta_target_id = $post->ID;
			}

			if ( isset($post) && $post->ID == 0 ) {
				global $wp_query;
				if ( isset( $wp_query->queried_object->ID ) ) { $meta_target_id = $wp_query->queried_object->ID; }
			}

		} 

		return $default_position;
	}
}

if( ! function_exists( 'ilovewp_helper_get_header_layout' ) ) {
	function ilovewp_helper_get_header_layout() {

		global $post;

		$themeoptions_header_layout = get_theme_mod( 'theme-nutmeg-header-layout', '1' );
		$default_position = 'site-header-layout--' . esc_attr($themeoptions_header_layout);

		return $default_position;
	}
}

if( ! function_exists( 'ilovewp_helper_get_animations' ) ) {
	function ilovewp_helper_get_animations() {

		global $post;

		$default_position = '';
		$themeoptions_animation_thumbnails = get_theme_mod( 'theme-nutmeg-transform-animation-thumbnails', '1' );
		
		if ( $themeoptions_animation_thumbnails == 1 ) {
			$default_position = 'page-with-animations';
		}
		return $default_position;
	}
}

if( ! function_exists( 'ilovewp_helper_display_sidebar' ) ) {
	function ilovewp_helper_display_sidebar() {

		if ( ilovewp_helper_get_sidebar_position() != 'page-withoutsidebar' ) {
			get_sidebar();
		}
			
	}
}

/* Convert HEX color to RGB value (for the customizer)						
==================================== */

if( ! function_exists( 'ilovewp_hex2rgb' ) ) {
	function ilovewp_hex2rgb($hex) {
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
}

if( ! function_exists( 'ilovewp_verify_hexcolor' ) ) {
	function ilovewp_verify_hexcolor($color) {

		//Check for a hex color string '#123456'
		if (preg_match('/^#[a-f0-9]{6}$/i', $color)) {
			return $color;
		} elseif (preg_match('/^[a-f0-9]{6}$/i', $color)) //hex color is valid
		{
			return '#' . trim(strtolower($color));
		}
	}
}

/**
 * Adds a Sub Nav Toggle to the Expanded Menu and Mobile Menu.
 *
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param WP_Post  $item  Menu item data object.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return stdClass An object of wp_nav_menu() arguments.
 */
function nutmeg_add_sub_toggles_to_main_menu( $args, $item, $depth ) {

	// Add sub menu toggles to the Expanded Menu with toggles.
	if ( isset( $args->show_toggles ) && $args->show_toggles ) {

		$args->after  = '';

		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

			$args->after .= '<button class="sub-menu-toggle toggle-anchor"><span class="screen-reader-text">' . __( 'Show sub menu', 'nutmeg' ) . '</span><i class="fas fa-chevron-down"></i></span></button>';

		}
	} 

	return $args;

}

add_filter( 'nav_menu_item_args', 'nutmeg_add_sub_toggles_to_main_menu', 10, 3 );