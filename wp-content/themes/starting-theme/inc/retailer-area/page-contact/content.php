<?php

  $featimg = get_the_post_thumbnail_url();
  $thumbnail_id = get_post_thumbnail_id( $post->ID );
  $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

 ?>

<div class="container-fluid retailercontact">
  <div class="row">
    <div class="col-md-6">
      <img src="<?php echo $featimg ?>" alt="<?php echo $alt ?>">
    </div>
    <div class="col-md-6 retailercontact__content">
      <h2>Any Questions?</h2>
      <div class="row">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>

<?php

  include(locate_template("inc/retailer-area/page-contact/form.php"));


 ?>

<?php if($featimg) : ?>
  <div class="container-fluid">
    <!-- <div class="row" style="background: url(<?php echo $featimg; ?>) center center; height: 450px; background-size: cover; margin-bottom: 15px;"></div> -->
    <div class="row">
      <!-- <img style="width: 100%;" src="<?php echo $featimg; ?>" alt="<?php echo $alt ?>"> -->
    </div>
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
