<?php 
/*
Template Name: List Organizers & Venues
*/


// the query

global $post;

$venues = tribe_get_venues(); ?>
<h2>Venues</h2>
<?php foreach ( $venues as $post ) {
    setup_postdata( $post ); ?>

	<p><?php the_title(); ?>:  <?php echo tribe_get_venue_id(); ?></p>

	<?php }



$organizers = tribe_get_organizers(); ?>
<h2>Organizers</h2>
<?php foreach ( $organizers as $post ) {
	setup_postdata( $post ); ?>

	<p><?php the_title(); ?>:  <?php echo tribe_get_organizer_id(); ?></p>

	<?php }

?>
