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
    $additional_image = get_field('additional_image');
     ?>

     <div class="row retailer_children">

       <?php if($i % 2) : ?>

       <div class="col-md-6 retailer_children_count matchheight" style="background: #BAC2C6 url(<?php echo $additional_image ?>) center center no-repeat; background-size: cover">
         <p>#<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?></p>
       </div>

       <div class="col-md-6 col-lg-4 retailer_children_content matchheight">

         <div class="vert-align">
           <h2> <?php echo the_title(); ?></h2>
           <p>
             <?php echo $excerpt ?>
           </p>






           <?php if ( is_user_logged_in() ) : ?>

             <?php if( have_rows('price_list') ): ?>
             	<?php while( have_rows('price_list') ): the_row();
             		// vars
             		$priceRegion = get_sub_field('price_region');
             		$priceListPdf = get_sub_field('price_list_pdf');
             		?>
                 <?php if ($priceRegion == $current_user->price_region): ?>
                   <a class="more" href="<?php echo $priceListPdf ?>" download>
                     Download Price List
                   </a>
                 <?php endif; ?>
             	<?php endwhile; ?>
              <?php else:  ?>
                <a href="<?php echo the_permalink(); ?>" class="more">view more</a>
             <?php endif; ?>

           <?php endif; ?>
         </div>





       </div>

     <?php else : ?>

       <div class="col-md-6 retailer_children_count hidden-md hidden-lg" style="background: #BAC2C6 url(<?php echo $additional_image ?>) center center no-repeat; background-size: cover">
         <p>#<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?></p>
       </div>

       <div class="col-md-6 col-lg-4 col-lg-offset-2 retailer_children_content matchheight">

         <div class="vert-align">
           <h2> <?php echo the_title(); ?></h2>
           <p>
             <?php echo $excerpt ?>
           </p>

           <?php if ( is_user_logged_in() ) : ?>

             <?php if( have_rows('price_list') ): ?>
             	<?php while( have_rows('price_list') ): the_row();
             		// vars
             		$priceRegion = get_sub_field('price_region');
             		$priceListPdf = get_sub_field('price_list_pdf');
             		?>
                 <?php if ($priceRegion == $current_user->price_region): ?>
                   <a class="more" href="<?php echo $priceListPdf ?>" download>
                     Download Price List
                   </a>
                 <?php endif; ?>
             	<?php endwhile; ?>
              <?php else:  ?>
                <a href="<?php echo the_permalink(); ?>" class="more">view more</a>
             <?php endif; ?>

           <?php endif; ?>

         </div>

       </div>

       <div class="col-md-6 retailer_children_count hidden-xs hidden-sm matchheight" style="background: #BAC2C6 url(<?php echo $additional_image ?>) center center no-repeat; background-size: cover">
         <p>#<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?></p>
       </div>

     <?php endif; ?>

    </div>
    <?php $i++; endwhile; ?>
  </div>

  <?php endif; wp_reset_postdata(); ?>
