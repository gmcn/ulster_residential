<div class="container-fluid row rugs">
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-6 rugs_head_title matchheight">
        <h1><img src="<?php echo get_template_directory_uri(); ?>/images/rugs_title.svg" alt="<?php echo the_title(); ?>"> </h1></div>
      <div class="col-md-6 matchheight">
        <div class="rugs_head_content">
          <?php echo the_content(); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="rugs_head_rotate hidden-xs hidden-sm">
    <img src="<?php echo get_template_directory_uri(); ?>/images/rugs_rotate_bg.png)" alt="">

  </div>

</div>

<div class="rugs_steps">

  <?php if( have_rows('rugs_info') ): ?>

    <?php $i = 1; while( have_rows('rugs_info') ): the_row();

        // vars
        $section_image = get_sub_field('section_image');
        $section_title = get_sub_field('section_title');
        $section_text = get_sub_field('section_text');
        $section_bg_colour = get_sub_field('section_bg_colour');
        $section_call_to_action_title = get_sub_field('section_call_to_action_title');
        $section_cta_link = get_sub_field('section_cta_link');

    ?>

    <div class="row step step<?php echo $i ?>" style="background: url(<?php echo $section_image; ?>) fixed; margin-bottom: 15px; background-size: cover">

      <style media="screen">
        .step<?php echo $i ?> .st0 {
          fill: <?php echo $section_bg_colour ?> !important;
        }
      </style>

      <?php if ($i % 2) : ?>
        <?php

          $svgLeft = file_get_contents(get_template_directory_uri() . '/images/left_arrow_bg.svg');

         ?>

         <div class="row" style="width: 750px;  height: 1470px;  float: left">
           <?php echo $svgLeft ?>
           <img class="step_scroll_left animated bounce" src="<?php echo get_template_directory_uri() ?>/images/scroll-icon.svg" alt="<?php echo $section_title ?>">
           <div class="valign">
             <hr class="hidden-xs hidden-sm hidden-md" />
           <div class="col-xs-8 col-sm-6">

             <p class="hidden-lg counter">#0<?php echo $i; ?></p>

             <h2><?php echo $section_title ?></h2>
             <?php echo $section_text ?>

             <?php if ($section_cta_link): ?>
               <br />
               <a href="<?php echo $section_cta_link ?>">
                 <?php echo $section_call_to_action_title ?>
               </a>
             <?php endif; ?>

           </div>
           <div class="col-sm-6 col-lg-5 col-lg-offset-1 count" style="text-align: right">

             <p class="hidden-xs hidden-sm hidden-md">#0<?php echo $i; ?></p>

           </div>
         </div>
         </div>

      <?php else : ?>

        <?php

          $svgRight = file_get_contents(get_template_directory_uri() . '/images/right_arrow_bg.svg');

         ?>

         <div class="row" style="width: 750px; height: 50px; float: right">
           <img class="step_scroll_right animated bounce" src="<?php echo get_template_directory_uri() ?>/images/scroll-icon.svg" alt="<?php echo $section_title ?>">
           <?php echo $svgRight ?>
           <div class="valign right">
             <hr class="hidden-xs hidden-sm hidden-md" />
             <div class="col-sm-6 col-lg-5 count">

               <p class="hidden-xs hidden-sm hidden-md">#0<?php echo $i; ?></p>


             </div>
             <div class="col-xs-8 col-xs-offset-4 col-sm-7 col-sm-offset-5 col-md-7 col-md-offset-5 col-lg-7 col-lg-offset-0" style="text-align: right;">

               <p class="hidden-lg counter">#0<?php echo $i; ?></p>

               <h2><?php echo $section_title ?></h2>
               <?php echo $section_text ?>

               <?php if ($section_cta_link): ?>
                 <br />
                 <a href="<?php echo $section_cta_link ?>">
                   <?php echo $section_call_to_action_title ?>
                 </a>
               <?php endif; ?>

             </div>
           </div>
         </div>


      <?php endif; ?>

    </div>

    <?php $i++; endwhile; ?>

  <?php endif; ?>

</div>

<div class="container-fluid">

    <?php if( have_rows('rugs_info_bottom') ):

      $rugs_info_bottom_background_image = get_field('rugs_info_bottom_background_image');

      ?>

      <div class="rugs_info_bottom" style="background: url(<?php echo $rugs_info_bottom_background_image ?>) no-repeat center center / cover">

        <img class="stretch" src="<?php echo get_template_directory_uri() ?>/images/rugs_info_bottom.svg" alt="">

        <?php $arrowTop = file_get_contents(get_template_directory_uri() . '/images/rugs_info_bottom.svg'); ?>

        <?php //echo $arrowTop ?>

        <?php $i = 1; while( have_rows('rugs_info_bottom') ): the_row();

            // vars
            $bottom_section_icon = get_sub_field('bottom_section_icon');
            $bottom_section_title = get_sub_field('bottom_section_title');
            $bottom_section_text = get_sub_field('bottom_section_text');

        ?>

          <div class="row rugs_info_bottom_point">
            <div class="rugs_info_bottom_point_wrapper">
              <div class="container">
                <div class="col-sm-3 icon">
                  <img src="<?php echo $bottom_section_icon ?>" alt="<?php echo $bottom_section_title ?>">

                </div>

                <div class="col-sm-9 content">

                  <h3><?php echo $bottom_section_title ?></h3>
                  <?php echo $bottom_section_text ?>

                </div>
              </div>

              <div class="cf clear" style="clear:both;">

              </div>
            </div>
          </div>




      <?php endwhile; ?>

    <?php endif; ?>

  </div>
</div>
