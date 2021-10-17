<?php 
$display_searchform 		= get_theme_mod( 'theme-nutmeg-display-header-searchform', '1' );
if ( $display_searchform == '1' ) {
?>
<div id="site-masthead-search" class="ht-site-cell ht-site-cell--alignself-center ht-site-cell--nogrow">
	<button aria-label="<?php echo esc_attr('Expand container with Search Form','nutmeg'); ?>" id="site-search-toggle" class="site-toggle-searchform"><i class="fas fa-search"></i></button>
</div><!-- #site-masthead-search -->
<?php 
} // if search form displayed
?>