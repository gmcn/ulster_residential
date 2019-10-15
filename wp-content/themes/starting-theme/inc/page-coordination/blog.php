<?php if (is_page( 'colour-coordination' )): ?>
  
  <?php
  $args = array(
  'post_type' => 'post',
  'posts_per_page' => 5,
  'orderby' => 'date',
  'order' => 'DESC',
  'cat' => '11',
  );
  $blog_query = new WP_Query( $args ); ?>

    <?php if ($blog_query->have_posts()) : ?>

      <div class="container-fluid related-articles">

        <h3>Related Articles</h3>

        <div class="row">

          <?php while ($blog_query->have_posts()) : $blog_query->the_post();
          $thumbnail = get_the_post_thumbnail_url();
          $date = get_the_date('d.m.y');
           ?>

           <div class="col-md-3 col-lg-2 col-sm-6 related-articles_board wow fadeInUp">

             <div class="wrapper" style="background: url(<?php echo $thumbnail ?>) center center; height:320px; background-size: cover;">
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

<?php endif; ?>
