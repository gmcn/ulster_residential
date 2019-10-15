<div class="container-fluid gallery-single">
  <div class="row">
    <div class="col-md-6 gallery-single_thumb">

      <?php the_post_thumbnail(); ?>

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


</div>
