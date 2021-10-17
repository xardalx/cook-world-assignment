<aside id="site-sidebar-column" class="ht-site-cell ht-site-cell--nogrow">
	<div class="site-column-wrapper">
		<?php
		if (is_active_sidebar('sidebar-primary')) { ?>
		<div class="sidebar-widgets">
			<?php dynamic_sidebar( 'sidebar-primary' ); ?>
		</div><!-- .sidebar-widgets -->
		<?php } ?>
	</div><!-- .site-column-wrapper -->
</aside><!-- #site-sidebar-column .ht-site-cell .ht-site-cell--nogrow -->