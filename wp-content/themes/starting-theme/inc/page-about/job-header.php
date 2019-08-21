<?php

  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

 ?>

<div class="container-fluid careers_header">
  <div class="row">
    <div class="col-sm-4 hidden-xs">
      <img src="<?php echo $featured_img_url; ?>" alt="<?php echo the_title(); ?>">
    </div>
    <div class="col-sm-8">
      <?php echo the_content(); ?>
    </div>

  </div>
</div>
