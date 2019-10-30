<?php
if ( have_posts() ) :  ?>

<div class="container-fluid gallery">

  <?php

  /* Start the Loop */
  while ( have_posts() ) : the_post();

  $date = get_the_date('d.m.y');

  ?>

    <div class="col-sm-6 col-md-3 col-lg-2 gallery_board wow fadeInUp">

      <div class="wrapper" style="background: url(<?php the_post_thumbnail_url('large') ?>) center center; height:320px; background-size: cover;">
        <a href="<?php echo the_permalink(); ?>">
          <div class="hover">

            <h3><?php echo the_title(); ?></h3>

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

                  <h4>
                    <?php echo $terms_string; ?>
                  </h4>

                <?php endforeach; ?>
              <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endif; ?>

            <div class="vert-align hover_view">
              View Imagery
              <img src="<?php echo get_template_directory_uri(); ?>/images/plus_sign.svg">
            </div>


            <div class="hover_tags">
              <?php echo the_terms( $post->ID, 'post_tag', 'Image Tags: ', ', ' ); ?>
            </div>

          </div>
        </a>
      </div>

    </div>

  <?php endwhile; ?>

  <?php

    include(locate_template("inc/page-elements/pagination.php"));

   ?>

  <?php else : ?>

  <?php get_template_part( 'template-parts/content', 'none' ); ?>

  </div>

  <?php endif; ?>
