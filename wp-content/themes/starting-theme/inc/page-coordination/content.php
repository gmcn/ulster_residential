<div class="container-fluid brochure">
  <div class="row">
    <div class="col-md-4 brochure_thumb matchheight" style="background: url(<?php echo the_post_thumbnail_url(); ?>) center center; background-size: cover;">

    </div>
    <div class="col-md-8 brochure_content matchheight" >
      <?php echo the_content(); ?>

        <?php if( have_rows('brochures') ): ?>
        <div class="brochure_content_download">
          <hr />
          Click on a brochure to download or view in browser
        </div>
      <?php endif; ?>
      
    </div>
  </div>
</div>
