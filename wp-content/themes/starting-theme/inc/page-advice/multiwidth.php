<div class="container-fluid multiwidth">
  <div class="row">
    <div class="col-md-6 multiwidth_bg hidden-xs hidden-sm matchheight">

    </div>
    <div class="col-md-6 matchheight">
      <?php echo the_content(); ?>

      <?php if( have_rows('multiwidth_benefits') ): ?>



      	<?php while( have_rows('multiwidth_benefits') ): the_row();

      		// vars
      		$benefitsImage = get_sub_field('benefits_image');
      		$benefitsDescription = get_sub_field('benefits_description');

      		?>
          <div class="row">
            <div class="multiwidth_benefit clearfix">
              <div class="col-xs-3 col-md-2">
                <img src="<?php echo $benefitsImage; ?>" alt="<?php echo $benefitsDescription; ?>">
              </div>

              <div class="col-xs-7 col-md-8">
                <?php echo $benefitsDescription; ?>
              </div>
            </div>
          </div>

      	<?php endwhile; ?>

      <?php endif; ?>

    </div>
  </div>
</div>
