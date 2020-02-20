<div class="container-fluid gallery-single">
  <div class="row">
    <div class="col-md-6 gallery-single_thumb">

      <?php the_post_thumbnail('large'); ?>

    </div>
    <div class="col-sm-6 col-md-3 gallery-single_content">

      <h2><?php echo the_title(); ?></h2>

      <?php

        $post_objects = get_field('ranges_included');

        if( $post_objects ): ?>
          <?php foreach( $post_objects as $post):

            $thumbnail = get_the_post_thumbnail_url();
            $excerpt = get_the_excerpt();

            $term_obj_list = get_the_terms( $post->ID, 'ranges_type' );
            $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));

            ?>
            <?php setup_postdata($post); ?>

            <h3>
              <?php echo $terms_string; ?>
            </h3>

          <?php endforeach; ?>
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      <?php endif; ?>

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
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        </div>
      <?php endif; ?>

    </div>

    <div class="col-sm-6 col-md-3 gallery-single_share">

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

      <div class="gallery-single_tags">
        <?php the_terms( $post->ID, 'post_tag', '<span>IMAGE TAGS:</span> ', ', ' ); ?>
      </div>



    </div>




  </div>

  <div class="row inspiration_action">
    <div class="col-xs-12 col-md-4 share">

        <?php next_post_link( '%link', '<img src="' . get_template_directory_uri() . '/images/prev.svg" /> Previous' ); ?>

    </div>
    <div class="col-xs-6 col-md-4 back">
      <a href="<?php echo site_url(); ?>/gallery/">Back to Gallery</a>
    </div>
    <div class="col-xs-6 col-md-4 next">

      <?php previous_post_link( '%link', 'Next <img src="' . get_template_directory_uri() . '/images/next.svg" />' ); ?>

    </div>
  </div>


</div>
