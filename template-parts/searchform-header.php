<?php 
$display_searchform 		= get_theme_mod( 'theme-nutmeg-display-header-searchform', '1' );
if ( $display_searchform == '1' ) {
?>
<div id="site-header-searchform">
	<form role="search" method="get" action="<?php echo esc_url(home_url()); ?>/" class="ht-site-flex">
		<input type="search" placeholder="<?php echo esc_attr('Search the website', 'nutmeg') ?>"  name="s" id="s" value="<?php echo esc_attr(get_search_query()); ?>" class="ht-site-cell" />
		<input type="submit" id="searchsubmit" value="<?php echo esc_attr('Search', 'nutmeg') ?>" class="ht-site-cell ht-site-cell--nogrow" />
	</form><!-- #site-header-searchform -->
</div><!-- #site-header-searchform -->
<?php 
} // if search form displayed
?>