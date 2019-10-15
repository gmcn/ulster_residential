<div class="container-fluid careers">

  <?php
  $args = array(
  'post_parent' => $post->ID,
  'post__not_in' => array(4510),
  'post_type' => 'page',
  'orderby' => 'menu_order',
  'order' => 'ASC'
  );

  $child_query = new WP_Query( $args );

  ?>

  <?php if($child_query->have_posts()) : ?>

      <?php $i = 1; while ( $child_query->have_posts() ) : $child_query->the_post();

      $job_title_extra = get_field('job_title_extra');
      $job_ref = get_field('job_ref');
      $job_location = get_field('job_location');
      $job_type = get_field('job_type');
      $closing_date = get_field('closing_date');
      $start_date = get_field('start_date');
      $salary = get_field('salary');
      $contract_duration = get_field('contract_duration');
      $excerpt = get_the_excerpt();

      ?>



      <div class="career">

        <div class="row career__title">
          <div class="col-md-4">
            <h2><?php the_title(); ?></h2>
            <p><?php echo $job_title_extra; ?></p>
          </div>

          <div class="col-md-8">
            <?php echo $excerpt; ?>
          </div>
        </div>


          <div class="row career__details">
            <div class="col-md-8">
              <div class="row">
                <div class="col-xs-6 col-lg-3">
                  <div class="label">
                    REFERENCE:
                  </div>
                  <?php echo $job_ref ?>
                </div>
                <div class="col-xs-6 col-lg-3">
                  <div class="label">
                    LOCATION:
                  </div>
                  <?php echo $job_location ?>
                </div>
                <div class="col-xs-6 col-lg-3">
                  <div class="label">
                    TYPE:
                  </div>
                  <?php echo $job_type ?>
                </div>
                <div class="col-xs-6 col-lg-3">
                  <div class="label">
                    CLOSING DATE:
                  </div>
                  <?php echo $closing_date ?>
                </div>
              </div>
            </div>
            <div class="col-md-4 buttons">
              <a href="<?php the_permalink(); ?>">View Details</a>
            </div>
          </div>



      </div>


      <?php $i++; endwhile; wp_reset_postdata(); ?>

  <?php else : ?>

    <div class="row">

      <div class="col-md-12">
        <h2>Ulser are not currently recruiting. However, please continue to review this page periodically for any update.</h2>
      </div>

    </div>

  <?php endif ?>

</div>
