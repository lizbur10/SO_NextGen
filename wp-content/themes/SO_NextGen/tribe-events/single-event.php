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

	if ( $venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
		$venue_details[] = $venue_name;
	}

	if ( $venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
		$venue_details[] = $venue_address;
	}

	$featured_image = get_field('featured_image');

	// Organizer
	$organizer = tribe_get_organizer();

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


	?>


	<!-- Event Cost -->
	<?php if ( tribe_get_cost() ) : ?>
		<div class="tribe-events-event-cost">
			<p><span><?php echo tribe_get_cost( null, true ); ?></span>
		</div>
	<?php endif; ?>

	<h1 class="page-title visually-hidden">Upcoming Events</h1>

	<!-- Event Title -->
	<?php do_action( 'tribe_events_before_the_event_title' ) ?>
	<h2 class="tribe-events-list-event-title entry-title summary">
		<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
			<?php the_title() ?>
		</a>
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
				else :
					echo tribe_get_start_date(null,FALSE,'F j'); ?> - <?php
					echo tribe_get_end_date(null,FALSE,'F j'); 
				endif; ?>

				<?php if (! ($rsvp == 'No')): ?>

					<button class="register-button">Register Now</button>
					<?php if ($rsvp == 'Non-members only'): ?>
						<p class="non-members-only"><strong>Note:</strong> Registration is required for non-members only</p>
					<?php endif; ?>
					<div id="outing-registration" class="visually-hidden">
						<form name="outing-registration" action="#" method="post">
							<p><label for="name">Name</label>: <input id="name" type="text" name="name" size="30" autofocus></p>
							<p><label for="email">E-mail</label>: <input id="email" type="email" name="email" size="30"></p>
							<p><label for="number_of_people">Number of people</label>: <input id="number_of_people" type="number" name="number_of_people" min="1" max="4" value="1" required></p>
							<button id="rsvp-button">RSVP Now</button><button id="cancel-button">Cancel</button>
						</form>
					</div>
					<div id="background-overlay" class="visually-hidden"></div>
					<div id="thanks-message" class="visually-hidden">Thanks for registering!</div>
				<?php endif; ?>
			</div>

			<!-- Event description -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content entry-content description">
				<?php the_content(); ?>
			</div>
			<!-- .tribe-events-single-event-description -->


			<!-- Event Meta -->
			<div class="event-details">
				<?php if (has_term('so-meeting','tribe_events_cat') ): 
					if ($venue_name) : ?>
						<dt class="field-label">Meet at: <?php echo $venue_name ?></dt>
					<?php else: ?>
						<p><span class="field-label">Meet at: </span>TBD</p>
					<?php endif;

					if($other_info): ?>
						<p class="other-info"><span class="field-label">Other info: </span></p>
							<p><?php echo $other_info ?></p>
					<?php endif; ?>

				<?php else: 
					if ( $venue_name ) : ?>
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
