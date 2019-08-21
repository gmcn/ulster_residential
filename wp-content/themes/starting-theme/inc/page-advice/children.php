  <?php
  $args = array(
  'post_parent' => $post->ID,
  'post_type' => 'page',
  'orderby' => 'menu_order',
  'order' => 'ASC'
  );
  $child_query = new WP_Query( $args ); ?>

    <?php if ($child_query->have_posts()) : ?>

        <div class="row advice_children">

          <?php
          while ($child_query->have_posts()) : $child_query->the_post();
          $thumbnail = get_the_post_thumbnail_url();
           ?>

            <div class="col-md-4 wow fadeInLeft matchheight">
              <a href="<?php echo the_permalink(); ?>">
                <img src="<?php echo $thumbnail ?>" alt="<?php echo the_title() ?>">
              </a>
            </div>

          <?php endwhile; ?>

        </div>

    <?php endif; wp_reset_postdata(); ?>
