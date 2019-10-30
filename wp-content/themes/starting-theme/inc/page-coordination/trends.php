<?php if( have_rows('seasonal_trends') ): ?>
    <div class="container-fluid trends brochures">
      <a name="trends"></a>
      <h3>Seasonal Trends</h3>
    	<div class="row">

    	<?php while( have_rows('seasonal_trends') ): the_row();

    		// vars
    		$trends_cover = get_sub_field('trends_cover');
    		$trends_title = get_sub_field('trends_title');
        $trends_file = get_sub_field('trends_file');

    		?>

        <div class="col-md-3 col-lg-2 col-xs-6 brochures_link wow fadeInDown">
          <div class="brochures_link_wrapper matchheight">

            <img src="<?php echo $trends_cover ?>" alt="<?php echo $trends_title ?>">

            <h4><?php echo $trends_title ?></h4>

            <div class="row">
              <div class="col-lg-6 brochures_link__links">
                <a class="view" href="<?php echo $trends_file ?>" target="_blank">View Now</a>
              </div>
              <div class="col-lg-6 brochures_link__links">
                <a class="download" href="<?php echo $trends_file ?>" download>Download</a>
              </div>
            </div>



          </div>

        </div>

    	<?php endwhile; ?>

    </div>
  </div>

<?php endif; ?>
