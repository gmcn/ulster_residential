<?php
/**
 * Note: The design shows a section in the banner 'tile' that seems to indicate that there should
 * be reference made to a particular project however none of the slides in the banner relate to
 * projects so this is not being coded.
 */
?>

<!-- BX Slider with Caption & Read More Link -->
<div id="bxslider">

	<?php if(have_rows('slider')): ?>

		<ul class="bxslider">

			<?php while(have_rows('slider')) : the_row();
					// ACF Sub fields
      		$slide_image = get_sub_field('slide_image');
      		$slide_title = get_sub_field('slide_title');
					$slide_title_bg = get_sub_field('slide_title_bg');
					$slide_link = get_sub_field('slide_link');
          $range_link = get_sub_field('range_link');
					$slide_cta_text = get_sub_field('slide_cta_text');
					?>

				<li class="slide" style="background:url(<?php echo $slide_image; ?>) center; background-size: cover">

          <div class="container-fluid">

            <div class="slide__title vert-align">
              <h1 class="wow fadeInLeft" style="background: <?php echo $slide_title_bg; ?>"><?php echo $slide_title; ?></h1><br />
							<a href="<?php echo $slide_link ?>" class="wow fadeInRight">
								<?php echo $slide_cta_text ?>
							</a>
            </div>

          </div>

          <?php if ($slide_project_title): ?>

            <div class="container slide-project__title">
              <span><?php echo $slide_project_title; ?></span>
              <?php if ($slide_project_link): ?>
                <a style="color: <?php echo $slide_title_colour ?>" href="<?php echo $slide_project_link ?>"> VIEW MORE</a>
              <?php endif; ?>

            </div>

          <?php endif; ?>

				</li>

			<?php endwhile; ?>

		</ul>
  <?php endif; ?>
<img class="scroll animated bounce" src="<?php echo get_template_directory_uri(); ?>/images/scroll-icon.svg" alt="">
</div>
