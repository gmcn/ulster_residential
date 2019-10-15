<?php if( have_rows('brochures') ): ?>
    <div class="container-fluid brochures">
    	<div class="row">

    	<?php while( have_rows('brochures') ): the_row();

    		// vars
    		$brochure_cover = get_sub_field('brochure_cover');
    		$brochure_title = get_sub_field('brochure_title');
        $brochure_file = get_sub_field('brochure_file');

    		?>

        <div class="col-sm-4 col-md-3 col-lg-2 brochures_link wow fadeInDown">
          <div class="brochures_link_wrapper matchheight">

            <div class="imgmatchheight">
              <img src="<?php echo $brochure_cover ?>" alt="<?php echo $brochure_title ?>">
            </div>

            <h4 class="hmatchheight"><?php echo $brochure_title ?></h4>

            <div class="row">
              <div class="col-lg-6 brochures_link__links">
                <a class="view" href="<?php echo $brochure_file ?>" target="_blank">View Now</a>
              </div>
              <div class="col-lg-6 brochures_link__links">
                <a class="download" href="<?php echo $brochure_file ?>" download>Download</a>
              </div>
            </div>

          </div>

        </div>

    	<?php endwhile; ?>

    </div>
  </div>

<?php endif; ?>
