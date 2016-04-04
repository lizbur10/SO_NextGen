<?php
/*
Template Name: Custom Homepage Template
*/

	get_header();


    $date = tribe_get_month_view_date();
?>

<h1 class="page-title visually-hidden">Welcome to Seniors Outdoors!</h1>

<div class="page-content">

    <section class="featured">
        <?php $found = false;
 
        $wp_query = new WP_Query( array( 'post_type' => 'tribe_events', 'nopaging' => true ) );

        if ( $wp_query->have_posts() ): ?>
            <div class="featured-event-details">
            <?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
    	    	if (has_term('featured-event','tribe_events_cat') AND !$found ) : 
                    $other_info = get_field('other_info');
                    $venue = tribe_get_venue();
    				$found = true;  ?>

                    <h2>Coming up:</h2>
    			    <h3 class="event-title"><?php the_title() ?></h3>
    			    <p class="single-space"><?php echo $venue; ?></p>
                    <p><?php echo the_event_start_date(null,FALSE,'l, F j'); ?></p>

                    <?php 
                    if (has_term('so-general-meeting','tribe_events_cat')) : ?>
                        <p class="single-space">New Member Orientation: 5:30 pm</p>
                        <p class="single-space">Social: 6:30 pm</p>
                        <p>Meeting: 7:00 pm</p>
                    <?php elseif ($other_info) : ?>
                        <p><?php echo $other_info; ?></p>
                    <?php endif;
    		        $content = the_content(); 
                endif; 
            endwhile; ?>
            </div>
        <?php endif; ?>
    </section>

    <section class="calendar-month-view">
        <h2 class="calendar-month-title">Outing Schedule</h2> 
        <h3 class="month-year"><?php echo tribe_event_format_date( $date, $displayTime = false, $dateFormat = 'F Y' ); ?></h3>
        <?php tribe_show_month(); ?>
    </section>


<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/header-slider.js"></script>

<?php get_footer(); ?>

