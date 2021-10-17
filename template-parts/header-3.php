<header id="site-masthead">
	<div class="site-section-wrapper">
		<div id="site-logo-masthead">
			<?php get_template_part( 'template-parts/header-logo' ); ?>
		</div><!-- #site-logo-masthead .ht-site-cell .ht-site-cell--nogrow -->
	</div><!-- .site-section-wrapper -->

	<?php if (has_nav_menu( 'primary' )) { ?>
	<div id="site-header-menu">
		<div class="site-section-wrapper">

			<div class="ht-site-flex ht-site-flex--masthead">
		
				<?php get_template_part( 'template-parts/mobile-menu-toggle' ); ?>

				<nav class="site-primary-nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'nutmeg' ); ?>">

					<?php 
					wp_nav_menu( array(
						'container' 			=> '', 
						'container_class' 		=> '', 
						'menu_class' 			=> 'large-nav sf-menu clearfix', 
						'menu_id' 				=> 'site-primary-menu', 
						'sort_column' 			=> 'menu_order', 
						'theme_location' 		=> 'primary', 
						'link_after' 			=> ''
					) );
					?>

				</nav><!-- .site-primary-nav -->

				<?php 
				get_template_part( 'template-parts/searchform-icon' );

				if (has_nav_menu( 'primary' ) || has_nav_menu( 'mobile' )) {
					get_template_part( 'template-parts/mobile-menu' );
				}
				?>

			</div><!-- .ht-site-flex .ht-site-flex--masthead -->

			<?php get_template_part( 'template-parts/searchform-header' ); ?>

		</div><!-- .site-section-wrapper -->

	</div><!-- #site-header-menu -->

	<?php } ?>

</header><!-- #site-masthead -->