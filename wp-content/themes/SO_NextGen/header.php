<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package seniorsoutdoors
 */


/*
Redirect code:
header("Location: http://new.seniorsoutdoors.org");
exit;
*/


//Sets a cookie so people will only see the splash screen the first time they visit the site:
setcookie('return_visitor', true, time() + (60*60*24*30));


//**NOTE: recipient for the feedback form is defined in functions.php, not here;
$feedbackEmail = "mailto:MORRISJP@uwec.edu"; //Can be deleted, I think


?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/modernizr.js"></script>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'seniorsoutdoors' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-container">
			<a href="<?php echo home_url(); ?>">
				<img id="logo" class="alignleft" src="<?php  echo get_stylesheet_directory_uri().'/images/SO_logo_small_cleaned.png' ; ?>" alt="<?php bloginfo( 'name' );?> ">
			</a>
			<div class="site-branding clear">
				<p class="site-title alignleft"><a href="<?php echo home_url(); ?>">Seniors Outdoors!</a></p>
				<p class="tagline alignright"><span>A club for active seniors</span><br/ > in Durango, Colorado</p>

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'seniorsoutdoors' ); ?></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' , 'menu_class' => 'nav-menu' ) ); ?>
				</nav><!-- #site-navigation -->
			</div><!-- site-branding -->
		</div>

	</header><!-- #masthead -->

 	<?php 
		$display_splash = $_COOKIE["return_visitor"];
		if (!($display_splash)) :
			echo "<div class=\"splash-container\">";
		else :
			echo "<div class=\"splash-container visually-hidden\">";
		endif;
	?>
<!--     <div class="splash-container">
 -->        <div class="splashscreen">
            <button class="so-button" id="splash-close">Close</button>
            <h3>Welcome to the redesigned Seniors Outdoors website!</h3>
            <br>
            <p>Please let us know what you think: what you like or don't like, what's missing, etc. </p>
            <br>
			<p><a class="centered text-link" id="trigger-splash-close" target="_blank" href="feedback-form">Submit Feedback</a></p>
            <p>(You can also use the button at the bottom of the screen at any time.)</p>
         </div>
    </div>

	<div id="content" class="site-content">
        <div class="email-link">
            <a class="so-button" target="_blank" href="feedback-form">Submit Feedback</a>
        </div>

	<script>
		$("#splash-close").click(function () {
		    $(".splash-container").hide();
		});
		$("#trigger-splash-close").click(function () {
		    $(".splash-container").hide();
		});
	</script>