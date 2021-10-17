<?php
$blog_page_id 			= get_option( 'page_for_posts' );
$blog_category  		= get_theme_mod( 'theme-nutmeg-recent-posts-category', 'none' );
$default_num_pp  		= get_theme_mod( 'theme-nutmeg-recent-posts-num', '4' );
$display_bloglink  		= get_theme_mod( 'theme-nutmeg-display-homepage-bloglink', 1 );

$home_loop = new WP_Query( array( 'posts_per_page' => $default_num_pp, 'orderby' => 'date', 'order' => 'DESC', 'category_name' => $blog_category ) );

if ( $home_loop->have_posts() ) { 

	$div_class 			= '';
	$thumbnail_name 	= 'nutmeg-thumb-landscape';

	$themeoptions_archives_style  		= get_theme_mod( 'theme-nutmeg-archives-style', 'standard' );
	$themeoptions_archives_layout 		= get_theme_mod( 'theme-nutmeg-archives-layout', 'columns-2' );
	$themeoptions_archives_thumbnail 	= get_theme_mod( 'theme-nutmeg-archives-thumbnail-size', 'nutmeg-thumb-landscape' );

	if ( $themeoptions_archives_style == 'standard' ) {
		$div_class 			.= 'site-archive-posts--standard';
	} elseif ( $themeoptions_archives_style == 'card' ) {
		$div_class 			.= 'site-archive-posts--cards';
	}

	if ( $themeoptions_archives_layout == 'list-even-columns' ) {
		$div_class 			.= ' site-archive-list site-archive-list--even-columns';
		$thumbnail_name 	= $themeoptions_archives_thumbnail;
	} elseif ( $themeoptions_archives_layout == 'list-fullwidth' ) {
		$div_class 			.= ' site-archive-list site-archive-list--full';
		$thumbnail_name 	= 'nutmeg-thumb-landscape-large';
	} elseif ( $themeoptions_archives_layout == 'columns-2' ) {
		$div_class 			.= ' site-archive-columns site-archive-columns--2';
		$thumbnail_name 	= $themeoptions_archives_thumbnail;
	} elseif ( $themeoptions_archives_layout == 'columns-3' ) {
		$div_class 			.= ' site-archive-columns site-archive-columns--3';
		$thumbnail_name 	= $themeoptions_archives_thumbnail;
	} elseif ( $themeoptions_archives_layout == 'columns-4' ) {
		$div_class 			.= ' site-archive-columns site-archive-columns--4';
		$thumbnail_name 	= $themeoptions_archives_thumbnail;
	}

	?>
	<div class="site-section-archives-posts <?php echo esc_attr($div_class); ?>">
	<ul class="site-archive-posts">

		<?php 
		$i = 0; 
		$themeoptions_display_post_thumbnails 	= get_theme_mod( 'theme-nutmeg-archives-display-thumbnail', 1 );
		
		$i = 0;
		while ($home_loop->have_posts()) : $home_loop->the_post(); 

		$classes = array('site-archive-post', 'ht-site-flex', 'ht-site-flex--direction-column', 'js-scroll', 'fade-in-bottom'); 	
		
		if ( !has_post_thumbnail() ) {
			$classes[] = 'post-nothumbnail';
		} elseif ( has_post_thumbnail() && $themeoptions_display_post_thumbnails == 1 ) {
			$classes[] = 'post-withthumbnail';
		}

		$image_attributes = array('alt' => esc_attr( __('Thumbnail for ','nutmeg' ) ) . get_the_title());
		?><li <?php post_class($classes); ?>>

			<?php if ( has_post_thumbnail() && $themeoptions_display_post_thumbnails == 1 ) { ?>
			<div class="entry-thumbnail ht-site-cell ht-site-cell--nogrow">
				<div class="entry-thumbnail-wrapper"><?php 

					echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
					the_post_thumbnail($thumbnail_name, $image_attributes);
					echo '</a>';
					?>
				</div><!-- .entry-thumbnail-wrapper -->
			</div><!-- .entry-thumbnail --><?php } ?>
			<div class="entry-preview ht-site-cell<?php if ( has_post_thumbnail() && $themeoptions_display_post_thumbnails == 1 ) { echo ' ht-site-cell--alignself-end'; } ?>">
				<div class="entry-preview-wrapper">
					<?php echo ilovewp_helper_display_postmeta_archives($post); ?>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php echo ilovewp_helper_display_excerpt($post); ?>
					<?php echo ilovewp_helper_display_postauthor_archives($post); ?>
					<?php echo ilovewp_helper_display_readmore($post); ?>
				</div><!-- .entry-preview-wrapper -->
			</div><!-- .entry-preview -->

		</li><!-- .site-archive-post --><?php $i++; endwhile; ?>
		
	</ul><!-- .site-archive-posts -->

	<?php
	if ( $blog_page_id != 0 &&  $display_bloglink == 1 ) {
	?><p class="site-cta-bloglink"><span class="site-cta-span"><a href="<?php echo esc_url(get_page_link($blog_page_id)); ?>" class="site-cta-anchor"><?php echo esc_html(get_theme_mod( 'theme-nutmeg-string-bloglink', __('View More Recipes', 'nutmeg') )); ?></a></span></p>
	<?php } ?>

	</div><!-- .site-section-archives-posts .site-archive-columns-2 -->
<?php } 
wp_reset_query();
?>