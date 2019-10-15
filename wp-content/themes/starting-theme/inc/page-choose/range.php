<?php

  $thumbnail = get_the_post_thumbnail_url();

 ?>

<div class="container-fluid choose_range" style="background: url(<?php echo $thumbnail ?>) center center; background-size: cover;">
  <div class="row">
    <div class="col-md-4 range">
      <div class="range__wrapper">
        <h3>Range</h3>
        <div class="clear"></div>
        <a href="/choose-a-carpet//ranges/">Search by</a>
      </div>
    </div>
    <div class="col-md-4 style">
      <div class="style__wrapper">
        <h3>Style</h3>
        <div class="clear"></div>
        <a href="/choose-a-carpet/style/">Search by</a>
      </div>
    </div>
    <div class="col-md-4 colour">
      <div class="colour__wrapper">
        <h3>Colour</h3>
        <div class="clear"></div>
        <a href="/choose-a-carpet/colour/">Search by</a>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid choose_children">
  <div class="row">

    <?php
    $args = array(
    'post_parent' => $post->ID,
    'post_type' => 'page',
    'posts_per_page' => 2,
    'orderby' => 'menu_order',
    'order' => 'ASC'
    );
    $child_query = new WP_Query( $args ); ?>

      <?php if ($child_query->have_posts()) : ?>

        <?php while ($child_query->have_posts()) : $child_query->the_post();
        $thumbnail = get_the_post_thumbnail_url();
         ?>

         <div class="col-md-3 choose_children_child matchheight wow fadeInLeft">

           <div class="wrapper" style="background: url(<?php echo $thumbnail ?>) center center; background-size: cover;">


               <a href="<?php echo the_permalink(); ?>">
                 <?php echo the_title(); ?>
               </a>


           </div>

         </div>



        <?php endwhile; ?>
      <?php endif; wp_reset_postdata(); ?>

      <div class="col-md-6 choose_children_content matchheight wow fadeInRight">
        <?php echo the_content(); ?>
      </div>

  </div>
</div>
