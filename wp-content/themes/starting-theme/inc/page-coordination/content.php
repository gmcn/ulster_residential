<div class="container-fluid brochure">
  <div class="row">
    <div class="col-md-4 brochure_thumb matchheight" style="background: url(<?php echo the_post_thumbnail_url(); ?>) center center; background-size: cover;">

    </div>
    <div class="col-md-8 brochure_content matchheight" >
      <?php echo the_content(); ?>

      <?php if( is_page('colour-coordination') ): ?>
      <div class="brochure_content_more">
        Click an area below to view
      </div>

      <div class="brochure_content_view">
        <div class="col-sm-4 col-lg-3 link">
          <a href="#trends">
            Seasonal <span>Trends</span>
          </a>
          <div class="link_shadow">

          </div>
        </div>
        <div class="col-sm-4 col-lg-3 link">
          <a href="#mood">
            Mood <span>Boards</span>
          </a>
          <div class="link_shadow">

          </div>
        </div>
        <div class="col-sm-4 col-lg-3 link">
          <a href="#coordination">
            Design <span>Articles</span>
          </a>
          <div class="link_shadow">

          </div>
        </div>
      </div>
    <?php endif; ?>


        <?php if( have_rows('brochures') ): ?>
        <div class="brochure_content_download">
          <hr />
          Click on a brochure to download or view in browser
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>
