<?php

  $featimg = get_the_post_thumbnail_url();

 ?>

<div class="container-fluid contact">
  <div class="row">
    <div class="col-md-6 col-md-offset-6">
      <h2>Any Questions?</h2>
    </div>
  </div>
  <div class="row contact__content">
    <div class="col-md-6 col-md-offset-6">
      <div class="row">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>

<?php if($featimg) : ?>
  <div class="container-fluid">
    <div class="row" style="background: url(<?php echo $featimg; ?>) center center; height: 450px; background-size: cover; margin-bottom: 15px;"></div>
  </div>
<?php endif; ?>

<?php
if ( is_user_logged_in() ) : ?>

<div class="container-fluid back">
  <div class="row">
    <div class="col-12">
      <a href="<?php echo site_url(); ?>/retailer-area">Back to retailer area</a> 
    </div>
  </div>
</div>

<?php endif; ?>
