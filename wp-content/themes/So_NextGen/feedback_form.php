<?php
/**
 * Template Name: Feedback Form Template
*/

 $feedbackEmail = "morrisjp@uwec.edu"; //this is for the text-link only; recipient for form itself is set in functions.php
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?> >
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

	<header id="masthead" class="site-header" role="banner">
		<div class="header-container">
			<a href="<?php echo home_url(); ?>">
				<img id="logo" class="alignleft" src="<?php  echo get_stylesheet_directory_uri().'/images/SO_logo_small_cleaned.png' ; ?>" alt="<?php bloginfo( 'name' );?> ">
			</a>
			<div class="site-branding clear">
				<p class="site-title alignleft"><a href="<?php echo home_url(); ?>">Seniors Outdoors!</a></p>

			</div><!-- site-branding -->
		</div>

	</header><!-- #masthead -->


<body <?php body_class(); ?> >
<div id="page" class="entry-content">
	<div class="feedback-form">
		<?php
			if($_GET["redirect"]) {
				echo "<p style=\"color:red; font-weight:bold;\">!! Please complete one or more of the questions and resubmit the form.</p>";
			}
		?>

		<h2>We want your opinion!</h2>
		<p>You can also email your feedback directly to the Webmaster, Joline Morrison, at <a class="text-link" href="mailto:<?php echo eae_encode_emails($feedbackEmail); ?>"><?php echo eae_encode_emails($feedbackEmail); ?></a>.</p>

<!--Used this article on how to set up post requests in WP: https://www.sitepoint.com/handling-post-requests-the-wordpress-way/
-->

		<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" id="feedback_form">
			<p>Your name: <input type="text" name="name" value=""></p>
			<p>Your email address (required): <input type="email" name="email" value="" required></p>
			<p class="question">What about the new site do you like?</p> 
			<textarea rows="8" name="likes"/></textarea>
			<p class="question">What don't you like?</p> 
			<textarea rows="8" name="dislikes"/></textarea>
			<p class="question">What's missing?</p> 
			<textarea rows="8" name="missing"/></textarea>
			<p class="question">Other feedback:</p> 
			<textarea rows="8" name="other"/></textarea>
			<input type="hidden" name="action" value="feedback_form">

		<p><input class="so-button" type="submit" name="submit" value="Submit Feedback" /></p>
			
		</form>
	</div>
</div>


	<footer id="colophon" class="site-footer" role="contentinfo">
		<p class="copyright">&copy; <?php echo date(Y); ?> Seniors Outdoors! <span class="wordp">| Powered by <a href="https://wordpress.org/" target="_blank">Wordpress</a></span></p>
		<p><span class="lizb">Site designed and developed by <a target="_blank" href="http://burtonux.com/">Liz Burton</a></span></p>

	</footer><!-- #colophon -->

</body>

</html>
