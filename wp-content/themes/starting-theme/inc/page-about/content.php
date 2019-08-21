<?php

  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

 ?>

<div class="container-fluid about_content" style="background: url(<?php echo $featured_img_url ?>) center center no-repeat; background-size: cover;">
  <div class="row">
    <?php echo the_content(); ?>
  </div>
</div>
