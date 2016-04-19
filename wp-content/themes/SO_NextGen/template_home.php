<?php
/*
Template Name: Custom Homepage Template
*/

	get_header();


    $date = tribe_get_month_view_date();
?>

<h1 class="page-title visually-hidden">Welcome to Seniors Outdoors!</h1>

<div class="page-content">
    <section id='image-slider'>
        <?php $images = get_field('image_gallery'); ?>
        <?php if( $images ): 
            $imageCounter = 1;
            $totalWidth = 0;
            foreach( $images as $image ): 
                $filename = $image['url'];
                list($width, $height) = getimagesize($filename);
                $newHeight = 240;
                $newWidth = (int) round(240/$height * $width);
                $ImageId = "galleryImage$imageCounter"; ?>
                <div style="left: <?php echo $totalWidth; ?>px;"><img id="<?php echo $ImageId ?>" class="slides" height="<?php echo $newHeight; ?>" width="<?php echo $newWidth; ?>" src="<?php echo $image['url']; ?>"  />
                </div>
                <?php $imageCounter++; 
                $totalWidth = $totalWidth + $newWidth; ?>
           <?php endforeach; ?>
        <?php endif; ?>
        <p class="slider-caption"><?php echo get_field('outing_name'); ?></p>

    </section>

    <section class="main-content">

        <section class="featured">
            <?php $featureFound = false;
     
            $wp_query = new WP_Query( array( 'post_type' => 'tribe_events', 'nopaging' => true ) );

            if ( $wp_query->have_posts() ): ?>
                <div class="featured-event-details">
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
        	    	if (has_term('general-meeting','tribe_events_cat') AND !$featureFound ) : 
                        $other_info = get_field('other_info');
                        $venue = tribe_get_venue();
        				$featureFound = true;  
                        $searchString = 'General Meeting'; 
                        $title= get_the_title(); ?>

                        <h2>SO! General Meeting</h2>
        			    <h3 class="event-title"><a href="<?php echo get_stylesheet_directory_uri(); ?>/<?php echo the_slug(); ?>"><?php the_title(); ?></a></h3>
        			    <p class="single-space"><?php echo $venue; ?></p>
                        <p><?php echo tribe_get_start_date(null,FALSE,'l, F j'); ?></p>
                        <?php 
                        if (strpos($title, $searchString) > -1 ) : ?>
                            <p class="single-space">New member orientation: 5:30pm</p>
                            <p class="single-space">Social: 6:30pm</p>
                            <p>Meeting: 7:00pm</p>
                        <?php elseif ($other_info) : ?>
                            <p><?php echo $other_info; ?></p>
                        <?php endif; ?>
            		    <?php the_content(); ?>
                    <?php endif; 
                    if (has_term('changed','tribe_events_cat')) : ?>
                        <div class="event-changes">
                            <h2>Schedule Changes</h2>
                            <h3><?php echo tribe_get_start_date(null,FALSE,'l, F j'); ?>: </h3>
                            <h4><?php the_title(); ?></h4>
                        </div>
                    <?php endif;
                endwhile; ?>
                </div>
            <?php endif; ?>

        </section>

        <section class="list-view">
           <?php $eventsPosted = 0;
            $wp_query = new WP_Query( array( 'post_type' => 'tribe_events', 'nopaging' => true ) ); ?>
            <h2>Upcoming Events:</h2>
            <?php if ( $wp_query->have_posts() ): ?>
                    <?php while ( ( $wp_query->have_posts() ) && ($eventsPosted < 5) ) : $wp_query->the_post();
                        if (!(has_term('general-meeting','tribe_events_cat'))) :
                           $startDate = tribe_get_start_date();
                           $endDate = tribe_get_end_date(); ?>
                            <div class="events-list">
                                <?php if (has_term('new','tribe_events_cat')) : ?>
                                    <h3 class="event-title"><span class="new-outing">NEW!</span><a href="<?php echo get_stylesheet_directory_uri(); ?>/<?php echo the_slug(); ?>"><?php the_title(); ?></a></h3>                                
                                <?php else : ?>
                                    <h3 class="event-title"><a href="<?php echo get_stylesheet_directory_uri(); ?>/<?php echo the_slug(); ?>"><?php the_title(); ?></a></h3>
                                <?php endif;
                                if ($startDate != $endDate) : ?>
                                    <p><?php echo tribe_get_start_date(null,FALSE,'l, F j'); ?> - <?php echo tribe_get_end_date(null,FALSE,'l, F j'); ?></p>
                                <?php else : ?>    
                                    <p><?php echo tribe_get_start_date(null,FALSE,'l, F j'); ?></p>
                                <?php endif; ?>
                                <?php the_content(); ?>
                            </div>
                        <?php else :
                            $eventsPosted--;
                        endif;
                    $eventsPosted++; 
                    endwhile; ?>
                <p><a class="text-link" href="/so_nextgen/events">Go to full calendar&rsaquo;&rsaquo;</a></p>
                <p><a class="text-link" href="/so_nextgen/printable-schedule">Go to printable schedule&rsaquo;&rsaquo;</a></p>
           <?php else : ?>
                <p>Sorry - no events found</p>
           <?php endif; ?>
        </section>

    </section>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/image-slider.js"></script>

<?php get_footer(); ?>

