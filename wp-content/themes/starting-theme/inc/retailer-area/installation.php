<?php if( have_rows('multiwidth_benefits') ): ?>

  <div class="container-fluid installation_multiwidth">
    <div class="row">

      <div class="col-md-6 col-md-offset-6 hidden-xs hidden-sm installation_multiwidth_logo">
        <img src="<?php echo site_url(); ?>/wp-content/uploads/2019/08/multiwidth-brand_black.svg" alt="Multiwidth">
      </div>

    	<?php while( have_rows('multiwidth_benefits') ): the_row();

    		// vars
    		$benefitsImage = get_sub_field('benefits_image');
    		$benefitsDescription = get_sub_field('benefits_description');

    		?>
        <div class="col-md-6">
          <div class="installation_multiwidth_benefit clearfix matchheight">
            <div class="col-sm-3 col-md-2 installation_multiwidth_benefit__img">
              <img src="<?php echo $benefitsImage; ?>" alt="<?php echo $benefitsDescription; ?>">
            </div>

            <div class="col-sm-7 col-md-8">
              <?php echo $benefitsDescription; ?>
            </div>
          </div>
        </div>

    	<?php endwhile; ?>

    </div>
    <div class="row installation_multiwidth_branding">

        <div class="col-md-6 col-md-offset-6">
          <?php if( have_rows('multiwidth_downloads') ): ?>

            <?php while( have_rows('multiwidth_downloads') ): the_row();

              // vars
              $multiwidth_dl_file = get_sub_field('multiwidth_dl_file');
              $multiwidth_dl_name = get_sub_field('multiwidth_dl_name');
              $multiwidth_dl_img = get_sub_field('multiwidth_dl_img');

              ?>

              <div class="col-sm-6 installation_download wow fadeInDown">

                <div class="installation_download_wrapper matchheight">

                  <div class="imgmatchheight">
                    <img src="<?php echo $multiwidth_dl_img ?>" alt="<?php echo $multiwidth_dl_name ?>">
                  </div>

                  <h4 class="hmatchheight"><?php echo $multiwidth_dl_name ?></h4>

                  <div class="row">
                    <div class="col-lg-6 brochures_link__links">
                      <a class="view" href="<?php echo $multiwidth_dl_file ?>" target="_blank">View Now</a>
                    </div>
                    <div class="col-lg-6 brochures_link__links">
                      <a class="download" href="<?php echo $multiwidth_dl_file ?>" download>Download</a>
                    </div>
                  </div>

                </div>

              </div>

            <?php endwhile; ?>

          <?php endif; ?>

      </div>
    </div>
  </div>

<?php endif; ?>


<?php if( have_rows('installation_details') ): ?>

<?php while( have_rows('installation_details') ): the_row();

  $installationHeading = get_sub_field('installation_heading');
  $installationIntro = get_sub_field('installation_intro');
  $installationContent = get_sub_field('installation_content');
  $counter ++;

 ?>

  <div class="container-fluid installation_details<?php
  if ($counter == 1) : ?> first<?php endif; ?>">
    <div class="row">
      <div class="col-md-6 col-md-offset-6">
        <h2><?php echo $installationHeading; ?></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 installation_details_intro">
        <?php echo $installationIntro; ?>
      </div>
      <div class="col-md-6">
        <?php echo $installationContent; ?>



        <div class="row">

            <?php if( have_rows('installation_download') ): ?>

            	<?php while( have_rows('installation_download') ): the_row();

            		// vars
            		$installation_dl_file = get_sub_field('installation_dl_file');
            		$installation_dl_name = get_sub_field('installation_dl_name');
            		$installation_dl_img = get_sub_field('installation_dl_img');

            		?>

                <div class="col-sm-6 installation_download wow fadeInDown">

                  <div class="installation_download_wrapper matchheight">

                    <div class="imgmatchheight">
                      <img src="<?php echo $installation_dl_img ?>" alt="<?php echo $installation_dl_name ?>">
                    </div>

                    <h4 class="hmatchheight"><?php echo $installation_dl_name ?></h4>

                    <div class="row">
                      <div class="col-lg-6 brochures_link__links">
                        <a class="view" href="<?php echo $installation_dl_file ?>" target="_blank">View Now</a>
                      </div>
                      <div class="col-lg-6 brochures_link__links">
                        <a class="download" href="<?php echo $installation_dl_file ?>" download>Download</a>
                      </div>
                    </div>

                  </div>

                </div>

            	<?php endwhile; ?>

            <?php endif; ?>

        </div>
      </div>
    </div>
  </div>

  <?php endwhile; ?>

<?php endif; ?>
