
/**
 * Month View Template
 * The wrapper template for month view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
 *
 * @package TribeEventsCalendar
 *
 */



<?php get_header(); ?>

	<h1 class="page-title">Welcome to Seniors Outdoors!</h1>


<section class="image-section">
	<?php $images = get_field('image_gallery'); ?>

    <p>My name is Pam</p>
<?php
    if( $images ): ?>
        <p>My name is Pam</p>
        <div id="slider" class="flexslider">
            <ul class="slides">
                <?php foreach( $images as $image ): ?>
                    <li>
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                        <p><?php echo $image['caption']; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</section>




<?php get_footer(); ?>