<?php if( have_rows('events') ): ?>
    <div class="container-fluid events">
    	<div class="row">

    	<?php while( have_rows('events') ): the_row();

    		// vars
    		$eventImg = get_sub_field('event_img');
        $eventTitle = get_sub_field('event_title');
    		$eventDate = get_sub_field('event_date');
        $eventUrl = get_sub_field('event_url');

    		?>

        <div class="col-sm-6 col-md-3 events_link wow fadeInDown">
          <div class="events_link_wrapper matchheight">

            <img src="<?php echo $eventImg ?>" alt="<?php echo $eventTitle ?>">

            <h3><?php echo $eventTitle ?></h3>
            <p><?php echo $eventDate ?></p>
            <?php if ($eventUrl) : ?>
              <a target="_blank" class="view" href="<?php echo $eventUrl ?>">Find Out More</a>
            <?php endif; ?>

          </div>

        </div>

    	<?php endwhile; ?>

    </div>
  </div>

<?php endif; ?>
