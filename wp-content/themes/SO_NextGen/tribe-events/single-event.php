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

	$venue_name = tribe_get_meta ('tribe_event_venue_name');

	$featured_image = get_field('featured_image');

	// Organizer
	$organizer = get_field('leader');
	$organizer_phone = get_field('leader_phone');
	$organizer_email = get_field('leader_email');
	$organizer_nospaces = str_replace(" ", "%20", $organizer);


	// Difficulty
	$difficulty = get_field('difficulty');

	// Total distance
	$total_distance = get_field('total_distance');

	//Elevation gain
	$elevation_gain = get_field('elevation_gain');

	//Carpool
	$carpool = get_field('carpool');

	//Dogs
	$dogs = get_field('dogs');

	//Limit
	$limit = get_field('limit');

	//RSVP
	$rsvp = get_field('rsvp');

	//Other info
	$other_info = get_field('other_info');
	$title = get_the_title();



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

			<div>
				<?php if ($featured_image) : ?>
					<img class="event-image" src="<?php the_field('featured_image') ?>" > 
				<?php endif; ?>
			</div>


			<!-- Schedule & Recurrence Details -->
			<div class="updated published time-details">
				<?php if ( !tribe_event_is_all_day( $event ) ):
					echo tribe_get_start_date(null,TRUE,'l, F j, g:i a');
					$rsvp_email="mailto:%22" . $organizer_nospaces . "%22%3c" . $organizer_email . "%3e?Subject=RSVP for " . $title . ", " . tribe_get_start_date(null,TRUE,'F j');
				else :
					echo tribe_get_start_date(null,FALSE,'F j'); ?> - <?php
					echo tribe_get_end_date(null,FALSE,'F j'); 
					$rsvp_email="mailto:%22" . $organizer_nospaces . "%22%3c" . $organizer_email . "%3e?Subject=RSVP for " . $title . ", " . tribe_get_start_date(null,TRUE,'F j') . " - " . tribe_get_end_date(null,FALSE,'F j');
				endif; ?>

				<?php if ( ($rsvp == 'Yes') OR ($rsvp == 'Non-members only') ): 
					$reg = true; ?>
					<button class="register-button"><a href="<?php echo $rsvp_email; ?>">Register by Email</a></button>
					
  					<?php if ($rsvp == 'Non-members only'): ?>
						<p class="non-members-only"><strong>Note:</strong> Registration is required for non-members only</p>
					<?php endif; ?>
 				<?php else :
					$reg = false;
				endif; ?>
			</div>

			<!-- Event description -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->


			<!-- Event Meta -->
			<div class="event-details">
					<?php if ( $venue_name ) : ?>
						<dt class="field-label">Meet at: <?php echo $venue_name ?></dt>
					<?php else: ?>
						<p><span class="field-label">Meet at: </span>TBD</p>
					<?php endif;

					if(have_rows('alternate_meeting_places')): ?>
						<p class="field-label">Alternate Meeting Places:</p>

						<?php while(have_rows('alternate_meeting_places')): the_row(); ?>

							<p class="alternate-meeting-places"><?php the_sub_field('meeting_place'); ?> @ <?php the_sub_field('time'); ?></p>


						<?php endwhile; 
					endif; ?>

					<?php if($difficulty): ?>
						<p><span class="field-label">Difficulty:  </span><?php echo $difficulty ?></p>
					<?php endif; 
					
					if ($total_distance): ?>
						<p><span class="field-label">Total distance:  </span><?php echo $total_distance ?> miles</p>
					<?php endif; 
					
					if ($elevation_gain): ?>
						<p><span class="field-label">Elevation gain:  </span><?php echo $elevation_gain ?> feet</p>
					<?php endif; 

					if ($organizer): ?>
						<p><span class="field-label">Organizer:  </span><?php echo $organizer ?></p>
					<?php endif; 

					if ($organizer_phone) : ?>
						<p><span class="field-label">Phone:  </span><?php echo $organizer_phone ?></p>
					<?php endif;

					if ($organizer_email) : ?>
						<p><span class="field-label">Email:  </span><?php echo $organizer_email ?></p>
					<?php endif;

					if($carpool): ?>
						<p><span class="field-label">Carpool:  </span>$<?php echo $carpool ?></p>
					<?php endif; 

					if($dogs): ?>
						<p><span class="field-label">Dogs:  </span><?php echo $dogs ?></p>
					<?php endif; 

					if($limit): ?>
						<p><span class="field-label">Limit:  </span><?php echo $limit ?></p>
					<?php endif; 

					if($other_info): ?>
						<p class="other-info"><span class="field-label">Other info:  </span></p>
						<p><?php echo $other_info ?></p>
					<?php endif; ?>


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
