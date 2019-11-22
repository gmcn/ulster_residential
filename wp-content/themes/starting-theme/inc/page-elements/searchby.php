<?php

  $range_background = get_field('range_background');
  $style_background = get_field('style_background');
  $colour_background = get_field('colour_background');

 ?>


<div class="container-fluid searchby">
  <div class="row">
    <div class="col-md-4 range">
      <div class="range__wrapper" style="background: url(<?php echo $range_background ?>) center center;
    background-size: cover;">
        <h3>Range</h3>
        <div class="clear"></div>
        <a href="<?php echo get_site_url(); ?>/choose-a-carpet/ranges/">Search by</a>
      </div>
    </div>
    <div class="col-md-4 style">
      <div class="style__wrapper" style="background: url(<?php echo $style_background ?>) center center;
    background-size: cover;">
        <h3>Style</h3>
        <div class="clear"></div>
        <a href="<?php echo get_site_url(); ?>/choose-a-carpet/style/">Search by</a>
      </div>
    </div>
    <div class="col-md-4 colour">
      <div class="colour__wrapper" style="background: url(<?php echo $colour_background ?>) center center;
    background-size: cover;">
        <h3>Colour</h3>
        <div class="clear"></div>
        <a href="<?php echo get_site_url(); ?>/choose-a-carpet/colour/">Search by</a>
      </div>
    </div>
  </div>
</div>
