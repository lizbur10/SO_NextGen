<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} 

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single vevent hentry">

	<?php

	// Setup an array of venue details for use later in the template
	//$venue_details = array();

/*	if ( $venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
		$venue_details[] = $venue_name;
	}

	if ( $venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
		$venue_details[] = $venue_address;
	}
*/


	// Leader Email
	$leader_email = get_field('leader_email');


	// Difficulty
	$difficulty_info = get_field('difficulty_info');

	// location
	$location_info = get_field('location_info');

	$title = get_the_title();

	//Change info
	$event_change = get_field('event_change');


	?>


	<h1 class="page-title visually-hidden">Event Details</h1>

	<!-- Event Title -->
	<?php do_action( 'tribe_events_before_the_event_title' ) ?>
	<h2 class="tribe-events-list-event-title entry-title summary">
        <?php if (has_term('new','tribe_events_cat')) : ?>
        	 <span class="new-outing"> New!</span>
		<?php endif; 
		the_title(); ?>
	</h2>
	<?php do_action( 'tribe_events_after_the_event_title' ) ?>




	<!-- Event Content -->
	<?php while ( have_posts() ) :  the_post(); ?>
		<div class="main-content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->


			<!-- Schedule & Recurrence Details -->
			<div class="updated published time-details">
				<?php if ( !tribe_event_is_all_day( $event ) ):
					echo tribe_get_start_date(null,TRUE,'l, F j, g:i a');
					$rsvp_email="mailto:" . $leader_email . "?Subject=RSVP for " . $title . ", " . tribe_get_start_date(null,TRUE,'F j');
				else :
					echo tribe_get_start_date(null,FALSE,'F j'); ?> - <?php
					echo tribe_get_end_date(null,FALSE,'F j'); 
					$rsvp_email="mailto:" . $leader_email . "?Subject=RSVP for " . $title . ", " . tribe_get_start_date(null,TRUE,'F j') . " - " . tribe_get_end_date(null,FALSE,'F j');
				endif; ?>

                <?php if ( get_field('event_change') ) : ?>
					<p class="changed"><?php echo get_field('event_change') ?></p>
				<?php endif; ?>

				<?php if ( ($leader_email) ): 
					$reg = true; ?>
					<a class="register-button" href="<?php echo eae_encode_emails($rsvp_email); ?>">Register by Email</a>
					
 				<?php else :
					$reg = false;
				endif; ?>
			</div>

			<!-- Event description -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
                <?php
                echo the_content(); 
/*                $description = get_the_content(); 
                $searchString = "[return]";
                $replaceString = "<br>";
                $start_position = strpos($description, $searchString);
                    while ($start_position > -1) :
                        $description = substr_replace($description,$replaceString,$start_position,8);
                        $start_position = strpos($description, $searchString);
                    endwhile;
                    echo $description; 
*/            
                ?>
			</div>
			<!-- .tribe-events-single-event-description -->


			<!-- Event Meta -->
			<div class="event-details">
					<?php if ( $location_info ) : ?>
						<p><span class="field-label">Location &amp; Time:</span> <?php echo $location_info ?></p>
					<?php else: ?>
						<p><span class="field-label">Meet at: </span>TBD</p>
					<?php endif;


					if($difficulty_info): ?>
						<p><span class="field-label">Difficulty Info:  </span><?php echo $difficulty_info ?></p>
					<?php endif;  ?>
					

			</div><!-- .tribe-events-event-meta -->
		</div>
	<?php endwhile; ?>

	<?php do_action( 'tribe_events_after_the_meta' ) ?>

	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php _e( 'Event Navigation', 'tribe-events-calendar' ) ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-footer -->

</div>

<?php get_footer(); ?>
