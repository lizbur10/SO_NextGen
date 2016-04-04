<?php
/**
 * Month View Template
 * The wrapper template for month view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} 

?>


<?php get_header(); ?>

	<h1 class="page-title">Upcoming Outings</h1>


<?php do_action( 'tribe_events_before_template' ) ?>


<!-- Main Events Content -->
<?php tribe_show_month(); ?>


<!-- Upcoming Meeting -->

<?php do_action( 'tribe_events_after_template' ) ?>







<?php get_footer(); ?>