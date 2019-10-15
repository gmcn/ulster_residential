<?php

  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

 ?>

<div class="container-fluid useful-links_content" style="background: url(<?php echo $featured_img_url ?>) left center no-repeat;">
  <div class="row">
    <?php echo the_content(); ?>
  </div>
</div>
