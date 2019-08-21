<?php

  $intro = get_field('advice_intro');

 ?>

<div class="container-fluid advice">
  <div class="row">
    <div class="col-md-5 intro">
      <?php echo $intro; ?>
    </div>
    <div class="col-md-5 col-md-offset-1 content">
      <?php echo the_content(); ?>
      <p class="content_instruction">Click an area below to find out more</p>
    </div>
  </div>

  <?php include(locate_template("inc/page-advice/children.php")); ?>

</div>
