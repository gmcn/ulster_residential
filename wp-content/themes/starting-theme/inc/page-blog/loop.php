<?php
if ( have_posts() ) :  ?>

<div class="container-fluid blog-articles">

  <?php

  /* Start the Loop */
  while ( have_posts() ) : the_post();

  $date = get_the_date('d.m.y');

  ?>

    <div class="col-xs-6 col-md-3 col-lg-2 blog-articles_board wow fadeInUp">

      <div class="wrapper" style="background: url(<?php the_post_thumbnail_url('large') ?>) center center; height:320px; background-size: cover;">
        <a href="<?php echo the_permalink(); ?>">
          <div class="hover">

            <div class="hover_date">
             <?php echo $date; ?>
            </div>

            <div class="vert-align">
              <h3><?php echo the_title(); ?></h3>
            </div>


            <div class="hover_view">
             View Post
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
