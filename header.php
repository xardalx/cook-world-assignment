<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="profile" href="//gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="container">

	<div class="site-wrapper-all">
		<a class="skip-link screen-reader-text" href="#site-main"><?php esc_html_e( 'Skip to content', 'nutmeg' ); ?></a>

		<?php
		$display_premasthead 		= get_theme_mod( 'theme-nutmeg-display-premasthead', '0' );
		$string_header 				= get_theme_mod( 'theme-nutmeg-string-header', __('Nutmeg is a powerful WordPress theme.', 'nutmeg') );
		$header_layout 				= absint(get_theme_mod( 'theme-nutmeg-header-layout', '1' ));
		if ( $display_premasthead == 1 && ($string_header != '' || has_nav_menu( 'secondary' )) ) {
		?>
		<div id="site-premasthead">
			<div class="site-section-wrapper">
				<div class="ht-site-flex">
					<div class="ht-site-cell">
						<p><?php echo esc_html($string_header); ?></p>
					</div><!-- .ht-site-cell -->
					<?php if ( has_nav_menu( 'secondary' ) ) { ?>
					<div class="ht-site-cell">
						<nav id="site-secondary-nav" aria-label="<?php esc_attr_e( 'Secondary Menu', 'nutmeg' ); ?>"><?php wp_nav_menu( array(
								'container' 		=> '', 
								'container_class'	=> '', 
								'menu_class' 		=> 'clearfix', 
								'menu_id' 			=> 'site-secondary-menu', 
								'sort_column' 		=> 'menu_order', 
								'theme_location' 	=> 'secondary', 
								'depth'				=> 1,
								'link_after' 		=> '' ) );
						?></nav><!-- #site-secondary-nav -->
					</div><!-- .ht-site-cell -->
					<?php } ?>
				</div><!-- .ht-site-flex -->
			</div><!-- .site-section-wrapper -->
		</div><!-- #site-premasthead -->
		<?php }
		get_template_part( 'template-parts/header-' . $header_layout );
		?>