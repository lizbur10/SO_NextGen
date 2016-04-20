<?php
/*
Template Name: Printable List Template
*/

	get_header();

	//Determine season
	$wp_query = new WP_Query( array( 'post_type' => 'tribe_events', 'nopaging' => true ) ); 
	$season = '';
	if ( $wp_query->have_posts() ): 
		while ( $wp_query->have_posts() )  : $wp_query->the_post();
			$month = tribe_get_start_date(null,false,'M');
			$year = tribe_get_start_date(null,false,'Y');
			if ($month == 'Mar' || $month == 'Apr') :
				$season = 'Spring';
			elseif ($month == 'Jul' || $month == 'Aug') :
				$season = 'Summer';
			elseif ($month == 'Oct' || $month == 'Nov') :
				$season = 'Fall';
			elseif ($month == 'Dec' || $month == 'Jan') :
				$season = 'Winter';
			endif; 
		endwhile;
	endif;
?>




<div class="page-content">
	<div class="events-list">
		<?php echo do_shortcode("[print-me target='.page-title, #printable-table']"); ?>
			<?php if ($season == "") : ?>
				<h1 class="page-title">Seniors Outdoors! Schedule</h1>
			<?php else : ?>
				<h1 class="page-title">Seniors Outdoors! Schedule - <?php echo $season ?> <?php echo $year ?></h1>
			<?php endif; ?>

		<section class="printable-table-wrapper">
			<?php $wp_query = new WP_Query( array( 'post_type' => 'tribe_events', 'nopaging' => true ) ); 
			if ( $wp_query->have_posts() ): ?>
				<table id="printable-table">
					<tr>
						<th class="date-loc">Date &amp; Location</th>
						<th class="outing-desc">Outing description</th>
						<th class="difficulty">Difficulty info</th>
					</tr>

					<?php while ( $wp_query->have_posts() )  : $wp_query->the_post();

						$startDate = tribe_get_start_date(false);
						$endDate = tribe_get_end_date(false); 

						$venue_name = tribe_get_venue() ;

						$featured_image = get_field('featured_image');

						// Organizer
						$organizer = get_field('leader');
						$organizer_phone = get_field('leader_phone');
						$organizer_email = get_field('leader_email');

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
						$other_info = get_field('other_info'); ?>

						<tr>
							<td>
								<?php if ($startDate != $endDate) : ?>
									<p><?php echo tribe_get_start_date(null,FALSE,'D, M j'); ?> - <?php echo tribe_get_end_date(null,FALSE,'D, F j'); ?></p>
								<?php else : ?>    
									<p><?php echo tribe_get_start_date(null,FALSE,'D, M j'); ?></p>
								<?php endif; ?>
								<?php if  ( ( $venue_name ) && ($startDate == $endDate) ) :  ?>
									<p><?php echo $venue_name ?> <?php echo tribe_get_start_time() ?></p>
								<?php endif; 
								if(have_rows('alternate_meeting_places')): ?>
									<?php while(have_rows('alternate_meeting_places')): the_row(); ?>
										<p class="alternate-meeting-places"><?php the_sub_field('meeting_place'); ?> <?php the_sub_field('time'); ?></p>
									<?php endwhile; 
								endif; ?>

							</td>
							<td>
							<h4><a class="text-link" href="<?php echo get_stylesheet_directory_uri(); ?>/<?php echo the_slug(); ?>"><?php the_title(); ?></a></h4>
								<?php if (has_term('changed','tribe_events_cat')) : ?>
									<p class="changed"><?php echo get_field('event_change'); ?></p>
								<?php else : 
									the_content(); 
								endif;
								if($other_info): ?>
									<span class="other-info"><?php echo $other_info ?></span></p>
								<?php endif; 
								if ($organizer): ?>
									Leader: <?php echo $organizer ?>, 
								<?php endif; 
								if ($organizer_phone) : ?>
									<?php echo $organizer_phone ?>, 
								<?php endif;
								if ($organizer_email) : ?>
									<?php echo $organizer_email ?>
								<?php endif; ?>
								</p>

								<?php if($carpool): ?>
									Carpool $<?php echo $carpool ?>. 
								<?php endif; 

									if ($dogs == "No") : ?>
										No dogs. 
									<?php elseif ($dogs == "Yes") : ?>
											Dogs ok. 
									<?php elseif ($dogs == "On-leash only") : ?>
											Dogs on leash only. 
										<?php endif;

								if($limit): ?>
									Limit: <?php echo $limit ?></p>
								<?php endif; ?>

							</td>
							<td>
								<?php if($difficulty): ?>
									<p><?php echo $difficulty ?></p>
								<?php endif; 
								
								if ($total_distance): ?>
									<p><?php echo $total_distance ?> miles</p>
								<?php endif; 
								
								if ($elevation_gain): ?>
									<p><?php echo $elevation_gain ?> feet</p>
								<?php endif; ?>
							</td>
				<?php endwhile; ?>
						</tr>
					</table>
					<p><a class="text-link" href="/so_nextgen/events">See calendar view&rsaquo;&rsaquo;</a></p>
			<?php else : ?>
				<p>Sorry - no events found</p>
			<?php endif; ?>
		</section>

<?php get_footer(); ?>
