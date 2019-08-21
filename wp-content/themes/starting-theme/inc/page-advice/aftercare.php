<?php

  $intro = get_field('advice_intro');

 ?>

<div class="container-fluid aftercare">
  <div class="row">
    <div class="col-md-6 col-md-offset-6">
      <h2><?php echo the_title(); ?></h2>
    </div>
    <div class="col-md-6 intro">
      <?php echo $intro ?>
    </div>
    <div class="col-md-6 content">
      <?php echo the_content(); ?>
    </div>
  </div>
</div>
