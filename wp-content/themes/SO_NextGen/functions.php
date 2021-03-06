<?php
/*
 * Disable JSON LD markup used by search engines
 */
add_filter( 'tribe_json_ld_markup', '__return_empty_string' );
/**
 * seniorsoutdoors functions and definitions
 *
 * @package seniorsoutdoors
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'seniorsoutdoors_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function seniorsoutdoors_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on seniorsoutdoors, use a find and replace
	 * to change 'seniorsoutdoors' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'seniorsoutdoors', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'seniorsoutdoors' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
*/
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'seniorsoutdoors_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // seniorsoutdoors_setup
add_action( 'after_setup_theme', 'seniorsoutdoors_setup' );

// Function to hide end time in list, map, photo, and single event view
// NOTE: This will only hide the end time for events that end on the same day
add_filter( 'tribe_events_event_schedule_details_formatting', 'remove_end_time', 10, 2);
function remove_end_time( $formatting_details ) {
 $formatting_details['show_end_time'] = 0;
 
 return $formatting_details;
}
 
// Function to hide end time in Week and Month View Tooltips
// NOTE: This will hide the end time in tooltips for ALL events, not just events that end on the same day
add_filter( 'tribe_events_template_data_array', 'remove_end_time_tooltips', 10, 3 );
function remove_end_time_tooltips( $json_array, $event, $additional ) {
 $json_array['endTime'] = '';
 
 return $json_array;
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function seniorsoutdoors_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'seniorsoutdoors' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'seniorsoutdoors_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function seniorsoutdoors_scripts() {
	wp_enqueue_style( 'seniorsoutdoors-style', get_stylesheet_uri() );

	wp_enqueue_style( 'seniorsoutdoors-font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css' );

	wp_enqueue_style( 'seniorsoutdoors-google-fonts', 'http://fonts.googleapis.com/css?family=Oswald|Merriweather:400,700|Open+Sans:400,400i,700' );

	wp_enqueue_script( 'seniorsoutdoors-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20120206', true );
	wp_localize_script( 'seniorsoutdoors-navigation', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'seniorsoutdoors' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'seniorsoutdoors' ) . '</span>',
	) );

	wp_enqueue_script( 'seniorsoutdoors-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'seniorsoutdoors_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/** Admin Slug Function */
function the_slug() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug;
}


/** My Functions */
function clean_events($event_string) {
	$event_string = str_replace('[return]', '<br>', $event_string); // Replaces [return]sdjwright001@gmail.com, liz.burton147@gmail.com with line breaks.
	$event_string = str_replace('Õ', "'", $event_string); //fixes apostrophe
	$event_string = str_replace('Í', "'", $event_string); //fixes apostrophe
	$event_string = str_replace('ê', "'", $event_string); //fixes apostrophe
	$event_string = str_replace('Ò', '"', $event_string); //fixes opening quote
	$event_string = str_replace('Ó', '"', $event_string); //fixes closing quote
	$event_string = str_replace('Ð', '-', $event_string); //fixes weird hyphen 
	$event_string = str_replace('\\', '<br>', $event_string); //replaces return code with br tag
	$event_string = str_replace('æ', " ", $event_string); // Removes special char
	return str_replace('Ê', ' ', $event_string); // Removes special char.
}

function clean_dates($input_date) {
	$formatted_date = strtotime($input_date);
	return strftime("%Y-%m-%d",$formatted_date);
}

function clean_times($input_time) {
	$formatted_time = strtotime($input_time);
	return strftime("%T",$formatted_time);
}

function prefix_send_email_to_admin() {
//	$to = "MORRISJP@uwec.edu, liz.burton147@gmail.com, djwright001@gmail.com";
	$to = "liz.burton147@gmail.com"; //FOR TESTING PURPOSES
	$subject = "SO feedback from Web form";
		$redirect_address = "get_stylesheet_directory_uri()/feedback-form?redirect=TRUE";
	if (empty($_POST["likes"]) && empty($_POST["dislikes"]) && empty($_POST["missing"]) && empty($_POST["other"])) { 
		redirect_to($redirect_address);
	} else {
		// Sanitize the POST field
		$name = sanitize_text_field($_POST['name']);  //change this to an array loop
		$email = sanitize_email($_POST['email']);
		$likes = sanitize_text_field($_POST['likes']);
		$dislikes = sanitize_text_field($_POST['dislikes']);
		$missing = sanitize_text_field($_POST['missing']);
		$other = sanitize_text_field($_POST['other']);
		// Generate email content
		$email_content = "FEEDBACK FROM: \r\n" . $name . "\r\n";
		$email_content .= "EMAIL ADDRESS: \r\n" . $email . "\r\n";
		$email_content .= "LIKES: \r\n" . wordwrap($likes, 50, "\r\n") . "\r\n";
		$email_content .= "DISLIKES: \r\n" . wordwrap($dislikes, 50, "\r\n") . "\r\n";
		$email_content .= "WHAT'S MISSING: \r\n" . wordwrap($missing, 50, "\r\n") . "\r\n";
		$email_content .= "OTHER FEEDBACK: \r\n" . wordwrap($other, 50, "\r\n") . "\r\n";

		// Send to appropriate email
		mail($to, $subject, $email_content);

		echo "<div style=\" text-align: center; margin: 5em auto;  width: 30em; display: block; padding: 2em; background-color: #F4EBDC; border: 3px solid #563A56; border-radius: 10px; \">
			<h1 style=\"color: #563A56; font-family: 'Merriweather'; \">Thank you for your feedback!</h1>
			<p style=\" font-family: 'Open Sans'; font-size: '24px'; \">Your comments and suggestions will help make this site as useful as possible for Seniors Outdoors! members.</p>
			</div>";
	}

}
add_action( 'admin_post_nopriv_feedback_form', 'prefix_send_email_to_admin' );
add_action( 'admin_post_feedback_form', 'prefix_send_email_to_admin' );


function redirect_to($new_location) {
	header("Location: " . $new_location);
	exit;
}

function check_if_recurring($post) {
    if (has_term('recurring','tribe_events_cat') || (has_term('bike','tribe_events_cat')) ||
    	(has_term('ww','tribe_events_cat')) || (has_term('ski','tribe_events_cat')) ) :
    return true;
	endif;
}