<div class="container-fluid detault-page">
  <div class="row">
    <div class="col-md-6 detault-page_thumb">
      <?php the_post_thumbnail(); ?>

      <?php

      $currentID = get_the_ID();

      $args = array(
      'post_type' => 'post',
      'posts_per_page' => 3,
      'orderby' => 'date',
      'order' => 'DESC',
      );
      $blog_query = new WP_Query( $args ); ?>

        <?php if ($blog_query->have_posts()) : ?>

          <div class="container-fluid inspiration_ranges hidden-xs hidden-sm">

            <div class="row">

              <h3>Articles coming up:</h3>

              <?php while ($blog_query->have_posts()) : $blog_query->the_post();
              $thumbnail = get_the_post_thumbnail_url();
              $excerpt = get_the_excerpt();
              $date = get_the_date('d.m.y');
               ?>

               <div class="col-xs-6 col-md-4 related-articles_board wow fadeInUp">

                 <div class="wrapper" style="background: url(<?php echo $thumbnail ?>) center center; height:288px; background-size: cover;">
                   <a href="<?php echo the_permalink(); ?>">
                     <div class="hover">

                       <div class="hover_date">
                        <?php echo $date; ?>
                       </div>

                       <div class="vert-align">
                         <?php echo the_title(); ?>
                       </div>


                       <div class="hover_view">
                        View Post
                       </div>

                     </div>
                   </a>
                 </div>

               </div>



              <?php endwhile; ?>


            </div>
          </div>

        <?php endif; wp_reset_postdata(); ?>

    </div>
    <div class="col-md-6 detault-page_content">
      <?php echo the_content(); ?>
    </div>
  </div>


  <div class="row inspiration_action">
    <div class="col-xs-12 col-md-4 share">

      <div class="dropdown">
      <a href="#" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        +Share
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
    <div class="col-xs-6 col-md-4 back">
      <a href="<?php echo site_url(); ?>/blog/">Back to blog</a>
    </div>
    <div class="col-xs-6 col-md-4 next">
      <?php $posts = query_posts($query_string); if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php previous_post_link( '%link', 'Next Post <img src="' . get_template_directory_uri() . '/images/next.svg" />' ); ?>
        <?php previous_post_link('','<img src="images/newer.png" />',''); ?>

      <?php endwhile; endif; ?>

      <?php
      if (!empty($nextID)) : ?>
      <div class="alignright">
      <a href="<?php echo get_permalink($nextID); ?>"
       title="<?php echo get_the_title($nextID); ?>">Next Moodboard <img src="<?php echo get_template_directory_uri() ?>/images/next.svg" alt=""> </a>
       </div>
     <?php endif; ?>

    </div>
  </div>

  <?php

  $currentID = get_the_ID();

  $args = array(
  'post_type' => 'post',
  'posts_per_page' => 3,
  'orderby' => 'date',
  'order' => 'DESC',
  );
  $blog_query = new WP_Query( $args ); ?>

    <?php if ($blog_query->have_posts()) : ?>

      <div class="container-fluid inspiration_ranges hidden-md hidden-lg">

        <div class="row">

          <h3>Articles coming up:</h3>

          <?php while ($blog_query->have_posts()) : $blog_query->the_post();
          $thumbnail = get_the_post_thumbnail_url();
          $excerpt = get_the_excerpt();
          $date = get_the_date('d.m.y');
           ?>

           <div class="col-xs-6 col-md-4 related-articles_board wow fadeInUp">

             <div class="wrapper" style="background: url(<?php echo $thumbnail ?>) center center; height:288px; background-size: cover;">
               <a href="<?php echo the_permalink(); ?>">
                 <div class="hover">

                   <div class="hover_date">
                    <?php echo $date; ?>
                   </div>

                   <div class="vert-align">
                     <?php echo the_title(); ?>
                   </div>


                   <div class="hover_view">
                    View Post
                   </div>

                 </div>
               </a>
             </div>

           </div>



          <?php endwhile; ?>


        </div>
      </div>

    <?php endif; wp_reset_postdata(); ?>


</div>
