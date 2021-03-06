<div class="container-fluid ulsterathome-single">
  <div class="row">
    <div class="col-md-6 ulsterathome-single_thumb matchheight">

      <?php the_post_thumbnail('large'); ?>

    </div>
    <div class="col-sm-6 col-md-3 ulsterathome-single_content matchheight">

      <h2><?php echo the_title(); ?></h2>

      <?php echo the_content(); ?>

      <?php
      $images = get_field('additional_images');

       if( $images ): ?>

       <a class="fancybox" rel="group" href="<?php echo the_post_thumbnail_url(); ?>" title="">

           View more images <img src="<?php echo get_template_directory_uri(); ?>/images/view_more_images.svg" alt="View More Images">

       </a>

        <!-- Hidden Gallery -->
        <div class="hidden">
          <?php foreach( $images as $image ): ?>

              <a class="fancybox" rel="group" href="<?php echo esc_url($image['sizes']['large']); ?>" title="<?php echo esc_html($image['caption']); ?>">

                  <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />

              </a>


          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    </div>

    <div class="col-sm-6 col-md-3 ulsterathome-single_related gallery-single_share matchheight">

      <?php

        $post_objects = get_field('ranges_included');

        if( $post_objects ): ?>
          <?php foreach( $post_objects as $post):

            $thumbnail = get_the_post_thumbnail_url();
            $excerpt = get_the_excerpt();

            $term_obj_list = get_the_terms( $post->ID, 'ranges_type' );
            $terms_string = join(', ', wp_list_pluck($term_obj_list, 'slug'));

            ?>
            <?php setup_postdata($post); ?>

            <a class="toplevel" href="<?php echo site_url(); ?>/ranges_type/<?php echo $terms_string; ?>">
              <div class="hover_view">
               + View The Range
              </div>
            </a>

          <?php endforeach; ?>
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      <?php endif; ?>

        <!-- <?php

          $post_objects = get_field('ranges_included');

          if( $post_objects ): ?>
            <?php foreach( $post_objects as $post):

              $thumbnail = get_the_post_thumbnail_url();
              $excerpt = get_the_excerpt();

              $term_obj_list = get_the_terms( $post->ID, 'ranges_type' );
              $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));

              $term_colour = get_the_terms( $post->ID, 'ranges_colour' );
              $terms_colour = join(', ', wp_list_pluck($term_colour, 'name'));

              $design_no = get_field('design_no');


              ?>
              <?php setup_postdata($post); ?>
              <a href="<?php echo the_permalink(); ?>">
                <div class="row ulsterathome-single_featured_range">
                  <div class="col-lg-5 ulsterathome-single_featured_range_img bordermatch">
                    <img src="<?php echo $thumbnail ?>" alt="<?php echo the_title(); ?>">
                  </div>
                  <div class="col-lg-7 ulsterathome-single_featured_range_details bordermatch">
                    Range: <span><?php echo $terms_string; ?></span><br  />
                    Design: <span><?php echo the_title(); ?></span><br  />
                    Colour: <span><?php echo $terms_colour; ?></span><br  />
                    Design No.: <span><?php echo $design_no; ?></span>
                  </div>
                </div>
              </a>

            <?php endforeach; ?>
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        <?php endif; ?> -->

        <div class="ulsterathome-single_share">
          <div class="dropdown">
            <a class="toplevel" href="#" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              + Share
            </a>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
              <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url($wp->request) ?>" onclick="return !window.open(this.href, '', 'width=550,height=400')" class="fb-xfbml-parse-ignore"><img src="<?php echo get_template_directory_uri() ?>/images/facebook_icon.svg" alt="Facebook"></a></li>

              <li><a class="twitter-share-button" href="https://twitter.com/intent/tweet?tweet?original_referer=<?php echo home_url($wp->request) ?>&text=<?php echo the_title(); ?> <?php echo home_url($wp->request) ?>" onclick="return !window.open(this.href, '', 'width=550,height=400')" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/twitter_icon.svg" alt="Twitter"></a></li>

              <li>
                <a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=<?php echo home_url($wp->request) ?>&media=<?php echo $thumbnail ?>!" onclick="return !window.open(this.href, '', 'width=550,height=400')" data-pin-custom="true"><img src="<?php echo get_template_directory_uri() ?>/images/pinterest_icon.svg" alt="Pinterest"></a>
              </li>

            </ul>
          </div>
        </div>



    </div>
  </div>

  <div class="row inspiration_action">
    <div class="col-xs-12 col-md-4 share">

      <?php next_post_link( '%link', '<img src="' . get_template_directory_uri() . '/images/prev.svg" /> Previous' ); ?>

    </div>
    <div class="col-xs-6 col-md-4 back">
      <a href="<?php echo site_url(); ?>/ulsterathome/">Back to #ulsterathome</a>
    </div>
    <div class="col-xs-6 col-md-4 next">

      <?php previous_post_link( '%link', 'Next <img src="' . get_template_directory_uri() . '/images/next.svg" />' ); ?>

    </div>
  </div>


</div>
