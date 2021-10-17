<header id="site-masthead">
	<div class="site-section-wrapper">
		<div class="ht-site-flex ht-site-flex--masthead">
			<?php if (has_nav_menu( 'primary-left' )) { ?>
			<div id="site-header-menu-left" class="ht-site-cell ht-site-cell--alignself-center">
				<nav class="site-primary-nav" aria-label="<?php esc_attr_e( 'Primary Menu - Left Side', 'nutmeg' ); ?>">

					<?php 
					wp_nav_menu( array(
						'container' 			=> '', 
						'container_class' 		=> '', 
						'menu_class' 			=> 'large-nav sf-menu clearfix', 
						'menu_id' 				=> 'site-primary-menu-left', 
						'sort_column' 			=> 'menu_order', 
						'theme_location' 		=> 'primary-left', 
						'link_after' 			=> ''
					) );
					?>

				</nav><!-- .site-primary-nav -->

			</div><!-- #site-header-menu .ht-site-cell -->
			<?php } ?>
			<div id="site-logo-masthead" class="ht-site-cell">
				<?php get_template_part( 'template-parts/header-logo' ); ?>
			</div><!-- #site-logo-masthead .ht-site-cell .ht-site-cell--nogrow -->
			<?php

			if (has_nav_menu( 'primary-right' )) { ?>
			<div id="site-header-menu-right" class="ht-site-cell ht-site-cell--alignself-center">
				<nav class="site-primary-nav" aria-label="<?php esc_attr_e( 'Primary Menu - Right Side', 'nutmeg' ); ?>">

					<?php 
					wp_nav_menu( array(
						'container' 			=> '', 
						'container_class' 		=> '', 
						'menu_class' 			=> 'large-nav sf-menu clearfix', 
						'menu_id' 				=> 'site-primary-menu-right', 
						'sort_column' 			=> 'menu_order', 
						'theme_location' 		=> 'primary-right', 
						'link_after' 			=> ''
					) );
					?>

				</nav><!-- .site-primary-nav -->

			</div><!-- #site-header-menu .ht-site-cell -->
			<?php }

			get_template_part( 'template-parts/mobile-menu-toggle' );

			get_template_part( 'template-parts/searchform-icon' );
			
			if (has_nav_menu( 'primary' ) || has_nav_menu( 'mobile' )) {
				get_template_part( 'template-parts/mobile-menu' );
			}

			?>

		</div><!-- .ht-site-flex .ht-site-flex--masthead -->

		<?php 
		get_template_part( 'template-parts/searchform-header' );
		?>

	</div><!-- .site-section-wrapper -->

</header><!-- #site-masthead -->