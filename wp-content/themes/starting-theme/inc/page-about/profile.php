<?php

  $intro = get_field('company_profile_intro');

 ?>

<div class="container-fluid company-profile">
  <div class="row">
    <div class="col-md-6 col-md-offset-6">
      <h2>Behind The Brand</h2>
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
      $video_description = get_sub_field('video_description');
      $download = get_sub_field('download');
      $mediaTitle = get_sub_field('media_title');
      $linkBg = get_sub_field('link_bg_colour');

  		?>

  		<div class="col-sm-6 col-md-3 company-profile_media matchheight" >

        <div class="company-profile_media_wrapper" style="background: url(<?php echo $backgroundImage ?>) center center no-repeat; background-size: cover; height: 100%;">


        <?php if ($mediaType == 'gallery') : ?>


          <img src="<?php echo get_template_directory_uri(); ?>/images/gallery_icon.svg" alt="gallery"><br />

          <a style="background:<?php echo $linkBg; ?>" href="#" class="open-album" data-open-id="group<?php echo $i ?>"><?php echo $mediaTitle; ?></a>

          <?php if( have_rows('gallery_images') ): ?>
            <div class="hidden">

          	<?php while( have_rows('gallery_images') ): the_row();

          		// vars
          		$gallery_image = get_sub_field('gallery_image');
          		$gallery_image_title = get_sub_field('gallery_image_title');
          		$gallery_image_description = get_sub_field('gallery_image_description');

          		?>

              <a class="image-show" rel="group<?php echo $i ?>" alt="<?php echo $gallery_image_title; ?>" alt="<?php echo $gallery_image_title; ?>" title="<?php echo $gallery_image_title; ?>">
                  <img src="<?php echo $gallery_image; ?>" alt="<?php echo $gallery_image_description; ?>" />
              </a>

          	<?php endwhile; ?>
            </div>
          <?php endif; ?>


        <?php elseif($mediaType == 'download') : ?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/download_icon.svg" alt="download"><br />

          <a style="background:<?php echo $linkBg; ?>" href="<?php echo $download ?>" download>
            <?php echo $mediaTitle ?>
          </a>

          <?php elseif($mediaType == 'video') : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/video_icon.svg" alt="<?php echo $mediaTitle; ?>"><br />
            <a style="background:<?php echo $linkBg; ?>" class="various fancybox fancybox.iframe" data-fancybox-type="iframe" alt="<?php echo $mediaTitle; ?>" title="<?php echo $mediaTitle; ?>" href="<?php echo $video ?>">
            <?php echo $mediaTitle ?>
            <img src="" alt="<?php echo $video_description; ?>" style="display:none;">
            </a>
          <?php endif; ?>

        </div>
      </div>
  	<?php $i++; endwhile; ?>

  </div>

  <?php endif; ?>

  <hr />

</div>
