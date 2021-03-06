<?php
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
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

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

	wp_enqueue_style( 'seniorsoutdoors-font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' );

	wp_enqueue_style( 'seniorsoutdoors-google-fonts', 'http://fonts.googleapis.com/css?family=Oswald|Open+Sans:400,600,700' );

	wp_enqueue_script( 'seniorsoutdoors-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'seniorsoutdoors-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery', false, false, false, false );

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

function send_RSVP( $organizer_email, $title ){ //https://teamtreehouse.com/community/use-wpmail-for-my-contact-forms

if ( $_POST['form'] != "outing-registration") { return; }

    // get the info from the from the form
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $number_of_people = $_POST['number_of_people'];
    $honeypot = trim($_POST['address']);
    $currenturl = trim($_POST['currenturl']);
    $redirect = trim($_POST['redirect']);

    //Do all my required fields have a value?
    if ( $name == '' AND $email == '' AND $number_of_people == '' ) {
        $error = $currenturl.'?status=emptyvalues';
        wp_redirect($error); exit;
    }

    //Email header injection exploit prevention
    foreach ( $_POST as $value ){
        if (stripos($value, 'Content-Type:') != FALSE ) {
            $error = $currenturl.'?status=tryagain';
            wp_redirect($error); exit;
        }
    }

    //the spam honey pot
    if ($honeypot != '') {
        $error = $currenturl.'?status=tryagain';
        wp_redirect($error); exit;
    }

    //validate the email addess
    if ( !is_email( $email )) {
        $error = $currenturl.'?status=email';
        wp_redirect($error); exit;
    }


    // Build the message
    $message  = "Name :" . $name ."\n";
    $message .= "Email :" . $email     ."\n";
    $message .= "Number of People :" . $number_of_people  ."\n";

    //set the form headers
    $headers = 'From: SO RSVP form';

    // The email subject
    $subject = 'RSVP for ' . $title;

    // Who are we going to send this form too
    $send_to = $organizer_email;


    if ( wp_mail( $send_to, $subject, $message, $headers ) ) {
        wp_redirect( $redirect ); exit;
    }

}

function awesome_form_errors() {

    if ( !$_SERVER['REQUEST_METHOD'] == 'GET') { return; }

    $status = $_GET['status'];

    if ($status == 'emptyvalues') {
        echo 'Please fill in all the fields and try again';
    } 

    elseif ($status == 'tryagain') {
        echo 'Oops we had a problem submitting your registration, please try again';
    }

    elseif ($status == 'email') {
        echo 'Please enter in a valid email address';
    }
}


