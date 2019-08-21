<?php

  $intro = get_field('company_profile_intro');

 ?>

<div class="container-fluid company-profile">
  <div class="row">
    <div class="col-md-6 col-md-offset-6">
      <h2>Behind The Brand The History</h2>
    </div>
    <hr />
  </div>
  <div class="row">
    <div class="col-md-6 company-profile_intro">
      <?php echo $intro; ?>
    </div>
    <div class="col-md-6">
      <?php echo the_content(); ?>
      <p class="company-profile_click">CLICK AN AREA BELOW TO FIND OUT MORE</p>
    </div>
    <hr />
  </div>

  <?php if( have_rows('company-profile-media') ): ?>

  	<div class="row">

  	<?php $i=1; while( have_rows('company-profile-media') ): the_row();

  		// vars
  		$backgroundImage = get_sub_field('background_image');
  		$mediaType = get_sub_field('media_type');
  		$galleryImages = get_sub_field('gallery_images');
      $video = get_sub_field('video');
      $download = get_sub_field('download');
      $mediaTitle = get_sub_field('media_title');
      $linkBg = get_sub_field('link_bg_colour');

  		?>

  		<div class="col-md-3 company-profile_media matchheight" >

        <div class="company-profile_media_wrapper" style="background: url(<?php echo $backgroundImage ?>) center center no-repeat; background-size: cover; height: 100%;">




        <?php if ($mediaType == 'gallery') : ?>


          <img src="<?php echo get_template_directory_uri(); ?>/images/gallery_icon.svg" alt="gallery"><br />

          <a style="background:<?php echo $linkBg; ?>" class="fancybox" href="#" rel="group<?php echo $i ?>" title="">
            <?php echo $mediaTitle; ?>
          </a>


          <?php if( $galleryImages ): ?>
          <!-- Hidden Gallery -->
          <div class="hidden">
            <?php foreach( $galleryImages as $galleryImage ): ?>

                <a class="fancybox" rel="group<?php echo $i ?>" title="">
                    <img src="<?php echo $galleryImage; ?>" alt="" />
                </a>

            <?php endforeach; ?>
          </div>
        <?php endif; ?>


        <?php elseif($mediaType == 'download') : ?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/download_icon.svg" alt="download"><br />

          <a style="background:<?php echo $linkBg; ?>" href="<?php echo $download ?>" download>
            <?php echo $mediaTitle ?>
          </a>

          <?php elseif($mediaType == 'video') : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/video_icon.svg" alt="video"><br />
            <a style="background:<?php echo $linkBg; ?>" class="various fancybox" data-fancybox-type="iframe" href="https://www.youtube.com/embed/<?php echo $video ?>?autoplay=1&amp;rel=0">
            <?php echo $mediaTitle ?>
            </a>
          <?php endif; ?>


        </div>
      </div>
  	<?php $i++; endwhile; ?>

  </div>

  <?php endif; ?>

  <hr />

</div>
