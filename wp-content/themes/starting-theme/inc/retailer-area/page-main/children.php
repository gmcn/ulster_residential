<?php
$args = array(
'post_parent' => $post->ID,
'post_type' => 'page',
'orderby' => 'menu_order',
'order' => 'ASC'
);
$child_query = new WP_Query( $args ); ?>

  <?php if ($child_query->have_posts()) : ?>
  <div class="container-fluid">



    <?php $i = 1;
    while ($child_query->have_posts()) : $child_query->the_post();
    $thumbnail = get_the_post_thumbnail_url();
    $excerpt = get_the_excerpt();
     ?>

     <div class="row retailer_children">

       <?php if($i % 2) : ?>

       <div class="col-md-6 retailer_children_count matchheight" style="background: #BAC2C6 url(<?php echo $thumbnail ?>) center center no-repeat; background-size: cover">
         <p>#<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?></p>
       </div>

       <div class="col-md-6 retailer_children_content matchheight">
         <h2> <?php echo the_title(); ?></h2>
         <p>
           <?php echo $excerpt ?>
         </p>
         <a href="<?php echo the_permalink(); ?>" class="more">view more</a>
       </div>

     <?php else : ?>

       <div class="col-md-6 retailer_children_content matchheight">
         <h2> <?php echo the_title(); ?></h2>
         <p>
           <?php echo $excerpt ?>
         </p>
         <a href="<?php echo the_permalink(); ?>" class="more">view more</a>
       </div>

       <div class="col-md-6 retailer_children_count matchheight" style="background: #BAC2C6 url(<?php echo $thumbnail ?>) center center no-repeat; background-size: cover">
         <p>#<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?></p>
       </div>

     <?php endif; ?>

    </div>

    <?php $i++; endwhile; ?>
  </div>

  <?php endif; wp_reset_postdata(); ?>
