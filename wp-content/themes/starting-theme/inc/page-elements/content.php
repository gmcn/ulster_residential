<?php

  $featImg = get_the_post_thumbnail();

 ?>


<div class="container-fluid detault-page">
  <div class="row">

    <?php if ($featImg): ?>
      <div class="col-md-5 detault-page_thumb">
        <?php echo $featImg ?>
      </div>
    <?php endif; ?>

    <div class="<?php if ($featImg): ?>col-md-7<?php else : ?>col-md-12<?php endif; ?> detault-page_content">
      <?php echo the_content(); ?>
    </div>
  </div>
</div>
