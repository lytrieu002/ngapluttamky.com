<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$blog_info    = get_bloginfo( 'name' );
$description  = get_bloginfo( 'description', 'display' );
$show_title   = ( true === get_theme_mod( 'display_title_and_tagline', true ) );
$header_class = $show_title ? 'site-title' : 'screen-reader-text';

?>

<div class="site-branding">

	<div class="collapse navbar-collapse">
		<a href="https://ngapluttamky.com/" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
      <i class="fas fa-home"></i>
    </a>
	</div>
</div><!-- .site-branding -->
