<?php
$args = array(
'post_parent' => $post->ID,
'post_type' => 'page',
'posts_per_page' => -1,
'orderby' => 'menu_order',
'order' => 'ASC'
);
$child_query = new WP_Query( $args ); ?>

  <?php if ($child_query->have_posts()) : ?>
    <a name="mood"></a>
    <div class="container-fluid mood-boards">

      <h3>Mood Boards</h3>

      <div class="row">

        <?php while ($child_query->have_posts()) : $child_query->the_post();
        $thumbnail = get_the_post_thumbnail_url();
        $excerpt = get_the_excerpt();
         ?>

         <div class="col-md-3 col-lg-2 col-sm-6 mood-boards_board wow fadeInUp">

           <div class="wrapper" style="background: url(<?php echo $thumbnail ?>) center center; height:320px; background-size: cover;">
             <a href="<?php echo the_permalink(); ?>">
               <div class="hover">

                 <div class="hover_date">
                  <?php echo the_date('d.m.y'); ?>
                 </div>

                 <div class="vert-align">
                   <?php echo the_title(); ?>
                 </div>


                 <div class="hover_view">
                  View
                 </div>

               </div>
             </a>
           </div>

         </div>



        <?php endwhile; ?>


      </div>
    </div>

  <?php endif; wp_reset_postdata(); ?>
