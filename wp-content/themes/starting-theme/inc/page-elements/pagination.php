<?php if ( get_the_posts_pagination() ) : ?>

  <div class="row col-md-12 pagination">
    <?php the_posts_pagination(
      array(
        'mid_size' => 2,
        'prev_text' => __( '<', 'textdomain' ),
        'next_text' => __( '>', 'textdomain' ),
        ));
      ?>
  </div>

<?php endif; ?>
