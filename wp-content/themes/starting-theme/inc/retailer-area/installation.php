<?php if( have_rows('multiwidth_benefits') ): ?>

  <div class="container-fluid installation_multiwidth">
    <div class="row">

      <div class="col-md-6 col-md-offset-6 hidden-xs hidden-sm installation_multiwidth_logo">
        <img src="/wp-content/uploads/2019/08/multiwidth-brand_black.svg" alt="Multiwidth">
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
        <?php
        if ($counter > 1) : ?>

        <div class="row">
          <div class="col-md-7">

            <?php if( have_rows('installation_video') ): ?>

            	<?php while( have_rows('installation_video') ): the_row();

            		// vars
            		$installation_yt_link = get_sub_field('installation_yt_link');
            		$installation_video_title = get_sub_field('installation_video_title');
            		$installation_video_description = get_sub_field('installation_video_description');

            		?>

            		<iframe width="100%" height="280" src="https://www.youtube.com/embed/<?php echo $installation_yt_link ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <strong><?php echo $installation_video_title ?></strong> <br />

                <?php echo $installation_video_description ?>

            	<?php endwhile; ?>

            <?php endif; ?>


          </div>
          <div class="col-md-5">
            <?php if( have_rows('installation_download') ): ?>

            	<?php while( have_rows('installation_download') ): the_row();

            		// vars
            		$installation_dl_file = get_sub_field('installation_dl_file');
            		$installation_dl_name = get_sub_field('installation_dl_name');
            		$installation_dl_description = get_sub_field('installation_dl_description');

            		?>

                <a href="<?php echo $installation_dl_file ?>" download>
                  <img class="download hidden-xs hidden-sm" src="/wp-content/uploads/2019/08/download_icon.svg" alt="Download">
                </a> <br />

                <strong><?php echo $installation_dl_name ?></strong> <br />

                <?php echo $installation_dl_description ?>

            	<?php endwhile; ?>

            <?php endif; ?>
          </div>
        </div>

        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php if ($counter == 1) : ?>


  <div class="container-fluid installation_calc">
    <div class="row">
      <div class="col-md-6 hidden-xs hidden-sm installation_calc_form matchheight">
        <h3>Area Calculator</h3>
        <form oninput="x.value=(parseInt(a.value)*parseInt(b.value)/parseInt(c.value)).toFixed(4)">
          <div class="row">
            <div class="col-md-6">
              <label for="a">Width (mm)</label>
              <input class="form-control" placeholder="Width (mm)" type="number" id="a" min="0" value="00">
            </div>
            <div class="col-md-6">
              <label for="b">Length (mm)</label>
              <input class="form-control" placeholder="Length (mm)" type="number" id="b" min="0" value="00">
            </div>
            <div class="col-md-6 result">
              <p>Required:</p>
              <input style="display: none" type="number" id="c" value="92903.04">
            </div>
            <div class="col-md-6 result">
              <div class="row">
                <div class="col-md-12">
                  <output name="x" for="a b c">0.0000</output> <span>SQFT</span>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-6 matchheight">
        <div class="row">
          <div class="col-sm-8">

            <?php if( have_rows('installation_video') ): ?>

            	<?php while( have_rows('installation_video') ): the_row();

            		// vars
            		$installation_yt_link = get_sub_field('installation_yt_link');
            		$installation_video_title = get_sub_field('installation_video_title');
            		$installation_video_description = get_sub_field('installation_video_description');

            		?>

            		<iframe width="100%" height="280" src="https://www.youtube.com/embed/<?php echo $installation_yt_link ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <strong><?php echo $installation_video_title ?></strong> <br />

                <?php echo $installation_video_description ?>

            	<?php endwhile; ?>

            <?php endif; ?>


          </div>
          <div class="col-sm-4">
            <?php if( have_rows('installation_download') ): ?>

            	<?php while( have_rows('installation_download') ): the_row();

            		// vars
            		$installation_dl_file = get_sub_field('installation_dl_file');
            		$installation_dl_name = get_sub_field('installation_dl_name');
            		$installation_dl_description = get_sub_field('installation_dl_description');

            		?>

                <a href="<?php echo $installation_dl_file ?>" download>
                  <img class="download" src="/wp-content/uploads/2019/08/download_icon_white.svg" alt="Download">
                </a> <br />

                <strong><?php echo $installation_dl_name ?></strong> <br />

                <?php echo $installation_dl_description ?>

            	<?php endwhile; ?>

            <?php endif; ?>
          </div>
        </div>

      </div>
      <div class="col-md-6 hidden-md hidden-lg installation_calc_form matchheight">
        <h3>Area Calculator</h3>
        <form oninput="x.value=(parseInt(a.value)*parseInt(b.value)/parseInt(c.value)).toFixed(4)">
          <div class="row">
            <div class="col-md-6">
              <label for="a">Width (mm)</label>
              <input class="form-control" placeholder="Width (mm)" type="number" id="a" min="0" value="00">
            </div>
            <div class="col-md-6">
              <label for="b">Length (mm)</label>
              <input class="form-control" placeholder="Length (mm)" type="number" id="b" min="0" value="00">
            </div>
            <div class="col-md-6 result">
              <p>Required:</p>
              <input style="display: none" type="number" id="c" value="92903.04">
            </div>
            <div class="col-md-6 result">
              <div class="row">
                <div class="col-md-12">
                  <output name="x" for="a b c">0.0000</output> <span>SQFT</span>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php endif ?>

  <?php endwhile; ?>

<?php endif; ?>
