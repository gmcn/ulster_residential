<?php if( have_rows('useful_links') ): ?>
    <div class="container-fluid useful">
    	<div class="row">

    	<?php while( have_rows('useful_links') ): the_row();

    		// vars
    		$useful_branding = get_sub_field('useful_branding');
        $useful_colour = get_sub_field('useful_branding_colour');
    		$useful_title = get_sub_field('useful_title');
        $useful_business = get_sub_field('useful_business');
        $useful_website = get_sub_field('useful_website');

    		?>

        <div class="col-md-3 col-xs-6 useful_link wow fadeInDown">
          <div class="useful_link_wrapper matchheight">

            <img src="<?php echo $useful_branding ?>" alt="<?php echo $useful_title ?>">

            <h3><?php echo $useful_title ?></h3>
            <p>Type of business:</p>
            <p><?php echo $useful_business ?></p>
            <a href="https://<?php echo $useful_website ?>" target="_blank"><?php echo $useful_website ?></a>

            <a class="view" style="background-color: <?php echo $useful_colour ?>" href="https://<?php echo $useful_website ?>" target="_blank">View site now</a>

          </div>

        </div>

    	<?php endwhile; ?>

    </div>
  </div>

<?php endif; ?>
