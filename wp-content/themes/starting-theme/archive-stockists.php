<?php

header("Content-Type: application/json; charset=UTF-8");


//get_header();
?>

  <?php

  // WP_Query arguments
  $args = array (

  'post_type'       => 'stockists',
  'post_status'     => 'publish',
  'posts_per_page'  => -1,

  );

  // The Query
  $loop = new WP_Query( $args );

  //the loop
  while ( $loop->have_posts() ) : $loop->the_post();

    // create an array if there is more than one result
    // $locations = array();

    $title = get_the_title();

     // Add in your custom fields or WP fields that you want
     $locations[] = array(
       'id' => get_the_ID(),
       'name' => $title,
       'address1' => get_field('address1'),
       'address2' => get_field('address2'),
       'address3' => get_field('address3'),
       'city' => get_field('city'),
       'zip' => get_field('zip'),
       'phone' => get_field('phone'),
       'email' => get_field('email'),
       'web' => get_field('web'),
       'stockist_id' => get_field('stockist_id'),
       'lng' => get_field('lng'),
       'lat' => get_field('lat')
     );

  endwhile;

  wp_reset_query();

  // output

  echo json_encode( $locations, JSON_PRETTY_PRINT );



  ?>
  <?php
  //get_footer();
