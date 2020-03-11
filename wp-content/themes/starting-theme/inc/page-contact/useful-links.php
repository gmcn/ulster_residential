<?php if( have_rows('useful_links') ): ?>
    <div class="container-fluid useful">
    	<div class="row">


          <?php if (is_page('contact')) : ?>
            <div class="col-md-6 hidden-xs hidden-sm">
              <p>Listed below are some other websites that you might be interested in:</p>
            </div>
          <?php else : ?>
            <div class="col-md-12 hidden-xs hidden-sm">
              <p>Listed below are some of Ulster Carpets manufacturing videos as well as other carpet related websites you might be interested in</p>
            </div>
          <?php endif; ?>



          <?php if (is_page('contact')) : ?>
            <div class="col-md-6">
              <h2>Useful Links</h2>
            </div>
          <?php else : ?>
          <?php endif; ?>

        <?php if (is_page('contact')) : ?>
          <div class="col-md-6 hidden-md hidden-lg">
            <p>Listed below are some other websites that you might be interested in:</p>
          </div>
        <?php else : ?>
          <div class="col-md-12 hidden-md hidden-lg">
            <p>Listed below are some of Ulster Carpets manufacturing videos as well as other carpet related websites you might be interested in<p>
          </div>
        <?php endif; ?>

    	<?php while( have_rows('useful_links') ): the_row();

    		// vars
    		$useful_branding = get_sub_field('useful_branding');
        $useful_colour = get_sub_field('useful_branding_colour');
    		$useful_title = get_sub_field('useful_title');
        $useful_business = get_sub_field('useful_business');
        $useful_website = get_sub_field('useful_website');

    		?>

        <div class="col-sm-6 col-md-3 useful_link wow fadeInDown">
          <div class="useful_link_wrapper matchheight">

            <img src="<?php echo $useful_branding ?>" alt="<?php echo $useful_title ?>">

            <h3 class="hmatchheight"><?php echo $useful_title ?></h3>
            <p>Type of business:</p>
            <p><?php echo $useful_business ?></p>
            <a href="http://<?php echo $useful_website ?>" target="_blank"><?php echo $useful_website ?></a>

            <a class="view" style="background-color: <?php echo $useful_colour ?>" href="http://<?php echo $useful_website ?>" target="_blank">View site now</a>

          </div>

        </div>

    	<?php endwhile; ?>

    </div>
  </div>

<?php endif; ?>
