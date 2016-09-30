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

<a class="printable-list text-link" href="/seniorsoutdoors/printable-schedule">Printable version&rsaquo;&rsaquo;</a>
<a class="printable-list text-link" href="/seniorsoutdoors/wp-content/uploads/2016/09/SOS_Schedule.pdf">SOS Schedule&rsaquo;&rsaquo;</a>


<?php do_action( 'tribe_events_before_template' ) ?>



<!-- Main Events Content -->
<?php tribe_show_month(); ?>


<!-- Upcoming Meeting -->

<?php do_action( 'tribe_events_after_template' ) ?>






<?php get_footer(); ?>