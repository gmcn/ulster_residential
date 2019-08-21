<?php
$args = array(
'post_parent' => $post->ID,
'post_type' => 'page',
'orderby' => 'menu_order',
'order' => 'ASC'
);
$child_query = new WP_Query( $args ); ?>

  <?php if ($child_query->have_posts()) : ?>

    <div class="container-fluid row">
      <div class="wrapper pre-about_children">
        <div class="col-md-6 col-md-offset-5">
            CLICK AN AREA BELOW TO FIND OUT MORE
        </div>
      </div>

    </div>

    <?php $i = 1;
    while ($child_query->have_posts()) : $child_query->the_post();
    $thumbnail = get_the_post_thumbnail_url();
    $excerpt = get_the_excerpt();
     ?>

     <div class="row about_children hidden-md hidden-sm">
       <div class="col-xs-3 hidden-md hidden-lg matchheight">
         <div class="about_children_count matchheight">
           <p>#<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?></p>
            <img class="about_img_mobile" src="<?php echo $thumbnail ?>" alt="<?php echo the_title() ?>">
         </div>

       </div>

       <div class="col-xs-9 hidden-md hidden-lg matchheight">
         <h2><?php echo the_title(); ?></h2>
         <p><?php echo $excerpt; ?></p>
         <a href="<?php echo the_permalink(); ?>">
           View More
         </a>
     </div>

   </div>

     <div class="row about_children hidden-xs hidden-sm">

       <div class="col-xs-3 about_children_count hidden-md hidden-lg matchheight">
         <p>#<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?></p>
          <img src="<?php echo $thumbnail ?>" alt="<?php echo the_title() ?>">
       </div>

       <div class="col-xs-9 hidden-md hidden-lg matchheight">
         <h2><?php echo the_title(); ?></h2>
         <p><?php echo $excerpt; ?></p>
         <a href="<?php echo the_permalink(); ?>">
           View More
         </a>
       </div>

       <div class="col-xs-8 col-md-4 matchheight">
         <?php if($i % 2) : ?>
           <img src="<?php echo $thumbnail ?>" alt="<?php echo the_title() ?>">
         <?php else : ?>
           <h2><?php echo the_title(); ?></h2>
           <p><?php echo $excerpt; ?></p>
           <a href="<?php echo the_permalink(); ?>">
             View More
           </a>
         <?php endif; ?>
       </div>

       <div class="col-xs-4 col-md-2 col-lg-1 about_children_count matchheight">
         <p>#<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?></p>
       </div>

       <div class="col-xs-12 col-md-6 matchheight">
         <?php if($i % 2) : ?>
           <h2><?php echo the_title(); ?></h2>
           <p><?php echo $excerpt; ?></p>
           <a href="<?php echo the_permalink(); ?>">
             View More
           </a>
         <?php else : ?>
           <img src="<?php echo $thumbnail ?>" alt="<?php echo the_title() ?>">
         <?php endif; ?>
       </div>

     </div>

    <?php $i++; endwhile; ?>

    <div class="container-fluid row">
      <div class="wrapper post-about_children">
      </div>
    </div>

  <?php endif; wp_reset_postdata(); ?>
