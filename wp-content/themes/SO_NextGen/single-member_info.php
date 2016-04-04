<?php


	get_header();
?>


 
    <h1 class="page-title visually-hidden">Member Information</h1>
    <img class="member-pic" src="<?php the_field('image'); ?>" alt="<?php the_field('first_name'); ?> <?php the_field('last_name'); ?>">

    <div class="member-info">
        <h2 class="member-name"><?php the_field('first_name'); ?>  <?php the_field('last_name'); ?></h2>
        <p><span class="field-label">Email:  </span><?php the_field('email'); ?></p>
        <p><span class="field-label">Phone:  </span><?php the_field('phone'); ?></p>
        <p><span class="field-label">Address:  </span><?php the_field('street_address'); ?>, <?php the_field('city'); ?>, <?php the_field('state'); ?> <?php the_field('zip_code'); ?></p>
        <?php if (get_field('spouse_first_name')): ?>
            <p><span class="field-label">Spouse/partner:  </span><?php the_field('spouse_first_name'); ?> <?php the_field('spouse_last_name'); ?></p>
        <?php endif; ?>
    </div>

<?php
    get_footer();
?>


