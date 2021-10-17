<?php 
$num_columns 					= get_theme_mod( 'theme-nutmeg-footer-columns', '3' );
$copyright_default 				= __('Copyright &copy; ', 'nutmeg') . date("Y",time()) . ' ' . get_bloginfo('name') . '. ';

if (is_active_sidebar('footer-fullwidth-1')) { ?>
<div id="site-prefooter" class="js-scroll fade-in-bottom">
	<div class="site-section-wrapper">
		<?php dynamic_sidebar( 'footer-fullwidth-1' ); ?>
	</div><!-- .site-section-wrapper -->
</div><!-- #site-prefooter -->
<?php } ?>
<footer id="site-colophon">

	<?php
	if ( $num_columns > 0 && (
		is_active_sidebar('footer-col-1') || 
		is_active_sidebar('footer-col-2') || 
		is_active_sidebar('footer-col-3') || 
		is_active_sidebar('footer-col-4') || 
		is_active_sidebar('footer-col-5')
	) ) { ?>
	<div class="js-scroll fade-in-bottom site-columns-footer site-columns-<?php echo esc_attr($num_columns); ?>">

		<div class="site-section-wrapper">

			<div class="ht-site-flex">
				<?php
				$i = 0;
				while ($i < $num_columns) { 
					$i++; 
					?><div class="ht-site-cell site-column site-column-<?php echo esc_attr($i); ?>">
					<div class="site-column-wrapper">
						<?php if (is_active_sidebar('footer-col-' . esc_attr($i) )) { ?>
							<?php dynamic_sidebar( 'footer-col-' . esc_attr($i) ); ?>
						<?php } ?>
					</div><!-- .site-column-wrapper -->
				</div><!-- .site-column .site-column-<?php echo esc_attr($i); ?> --><?php } ?>
			</div><!-- .ht-site-flex -->
		</div><!-- .site-section-wrapper -->

	</div><!-- site-columns .site-columns-footer .site-columns-<?php echo esc_attr($num_columns); ?> -->
	<?php } ?>

	<div id="site-footer-credits">

		<div class="site-section-wrapper">
			<div class="ht-site-flex">
				<?php if (has_nav_menu( 'footer' )) { ?>
				<nav class="ht-site-cell" id="site-footer-nav" aria-label="<?php esc_attr_e( 'Footer Menu', 'nutmeg' ); ?>">
					<?php wp_nav_menu( array(
						'container' 		=> '', 
						'container_class'	=> '', 
						'menu_class' 		=> 'clearfix', 
						'menu_id' 			=> 'site-footer-menu', 
						'sort_column' 		=> 'menu_order', 
						'theme_location' 	=> 'footer', 
						'depth'				=> 1,
						'link_after' 		=> '' ) );
					?>
				</nav><!-- #site-footer-nav .ht-site-cell -->
				<?php } ?>
			</div>
		</div><!-- .site-section-wrapper -->

	</div><!-- #site-footer-credits -->

</footer><!-- #site-colophon -->

</div><!-- .site-wrapper-all -->

</div><!-- #container -->
<?php 
wp_footer(); 
?>
</body>
</html>