<?php

  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

 ?>

<div class="container-fluid useful-links_content">
  <div class="row">

    <div class="col-md-6">
      <img src="<?php echo $featured_img_url ?>" alt="<?php echo the_title(); ?>">
    </div>

    <div class="col-md-6">
      <?php echo the_content(); ?>
    </div>

  </div>
</div>


  <?php if( have_rows('cta_box') ): ?>
    <div class="container-fluid">
      <div class="row retailer_cta_box">
      <?php while( have_rows('cta_box') ): the_row();

        // vars
        $cta_box_dl_file = get_sub_field('cta_box_dl_file');
        $cta_box_dl_name = get_sub_field('cta_box_dl_name');
        $cta_box_dl_img = get_sub_field('cta_box_dl_img');

        ?>

            <div class="col-md-4 wow fadeInLeft matchheight">
              <?php if ($cta_box_dl_file): ?>
                <a href="<?php echo $cta_box_dl_file; ?>">
              <?php endif; ?>
                <img src="<?php echo $cta_box_dl_img ?>" alt="<?php echo $cta_box_dl_name; ?>">
              <?php if ($cta_box_dl_file): ?>
                </a>
              <?php endif; ?>
            </div>



      <?php endwhile; ?>
      </div>
    </div>
  <?php endif; ?>
