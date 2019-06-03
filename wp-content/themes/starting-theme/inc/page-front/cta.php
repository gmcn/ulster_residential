<?php

  $cta1_colour = get_field('cta1_colour');
  $cta1_background_image = get_field('cta1_background_image');
  $cta1_title = get_field('cta1_title');
  $cta1_link = get_field('cta1_link');

  $cta2_colour = get_field('cta2_colour');
  $cta2_background_image = get_field('cta2_background_image');
  $cta2_title = get_field('cta2_title');
  $cta2_link = get_field('cta2_link');


 ?>

<div class="container-fluid cta">
  <div class="row">
    <div class="col-md-5 col1 wow fadeInLeft" style="background: url(<?php echo $cta1_background_image ?>) center center; background-size: cover;">
      <div class="vert-align">
        <h3 style="color: <?php echo $cta1_colour ?>"><?php echo $cta1_title ?></h3>
        <?php if ($cta1_link): ?>
          <br />
          <a style="background: <?php echo $cta1_colour ?>" href="<?php echo $cta1_link ?>">Click to view</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="col-md-2 col2 wow fadeInUp" style="background: url(<?php echo $cta2_background_image ?>) center center; background-size: cover;">
      <div class="vert-align">
        <h3 style="color: <?php echo $cta2_colour ?>"><?php echo $cta2_title ?></h3>
        <?php if ($cta2_link): ?>
          <br />
          <a style="background: <?php echo $cta2_colour ?>" href="<?php echo $cta2_link ?>">Click to view</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="col-md-5 col3 wow fadeInRight">
      <?php if( have_rows('rows') ): ?>
      	<?php while( have_rows('rows') ): the_row();

      		// vars
          $cta_colour = get_sub_field('cta_colour');
      		$cta_background_image = get_sub_field('cta_background_image');
      		$cta_title = get_sub_field('cta_title');
      		$cta_link = get_sub_field('cta_link');

      		?>
          <div class="col-md-12" style="background: url(<?php echo $cta_background_image ?>) center center; background-size: cover; ">
            <div class="vert-align">
              <h3 style="color: <?php echo $cta_colour ?>"><?php echo $cta_title; ?></h3>
              <?php if ($cta_link): ?>
                <br />
                <a style="background: <?php echo $cta_colour ?>" href="<?php echo $cta_link ?>">Click to view</a>
              <?php endif; ?>

            </div>
          </div>
      	<?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
