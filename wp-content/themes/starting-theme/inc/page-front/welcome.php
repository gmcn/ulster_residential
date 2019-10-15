<?php

  $welcome_bg = get_field('welcome_bg');
  $welcome_heading = get_field('welcome_heading');
  $welcome_copy = get_field('welcome_copy');

 ?>

<div class="container-fluid welcome_cta" style="background: url(<?php echo $welcome_bg ?>) center center; background-size: cover;">
  <div class="row">
    <div class="col-md-12">
      <h2><?php echo $welcome_heading; ?></h2>
      <?php echo $welcome_copy; ?>

      <?php if( have_rows('welcome_call_to_actions') ): ?>

      	<?php while( have_rows('welcome_call_to_actions') ): the_row();

      		// vars
      		$cta_title = get_sub_field('cta_title');
      		$cta_link = get_sub_field('cta_link');

      		?>

      			<a href="<?php echo $cta_link ?>"><?php echo $cta_title ?></a>

      	<?php endwhile; ?>

      <?php endif; ?>
    </div>
  </div>
</div>
