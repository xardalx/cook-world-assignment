<?php 
if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
	nutmeg_the_custom_logo();
} else { ?>
<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
<p class="site-description"><?php bloginfo( 'description' ); ?></p><?php } ?>