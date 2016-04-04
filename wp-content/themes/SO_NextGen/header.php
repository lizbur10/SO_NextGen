<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package seniorsoutdoors
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.11.3.min.js">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'seniorsoutdoors' ); ?></a>

		<div class="site-branding">
			<a href="<?php echo home_url(); ?>">
				<img id="logo" src="<?php  echo get_stylesheet_directory_uri().'/images/SO_logo_small_cleaned.png' ; ?>" alt="<?php bloginfo( 'name' );?> ">
				<p class="site-name">Seniors Outdoors!</p>
			</a>
		</div><!-- .site-branding -->

	<header id="masthead" class="site-header" role="banner">
	    <section id='header-slider'>
			<?php $images = get_field('image_gallery'); ?>
	        <?php if( $images ): 
	        	$imageCounter = 1;
	        	$totalWidth = 0;
                foreach( $images as $image ): 
		        	$filename = $image['url'];
		        	list($width, $height) = getimagesize($filename);
		        	$newHeight = 240;
		        	$newWidth = (int) round(240/$height * $width);
	               	$ImageId = "galleryImage$imageCounter"; ?>
                    <div style="left: <?php echo $totalWidth; ?>px;"><img id="<?php echo $ImageId ?>" class="slides" height="<?php echo $newHeight; ?>" width="<?php echo $newWidth; ?>" src="<?php echo $image['url']; ?>"  />
	                </div>
	                <?php $imageCounter++; 
	                $totalWidth = $totalWidth + $newWidth; ?>
               <?php endforeach; ?>
	        <?php endif; ?>

	    </section>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Primary Menu', 'seniorsoutdoors' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
