<?php

// WP_Query arguments
$args = array (

'post_type'       => 'stockists',
'post_status'     => 'publish',
'posts_per_page'  => -1,
'no_found_rows=true' => true,

);

// The Query
$loop = new WP_Query( $args );

// create an array if there is more than one result
$locations = array();

//the loop
while ( $loop->have_posts() ) : $loop->the_post();

   // Add in your custom fields or WP fields that you want
   $locations[] = array(
     'id' => get_the_ID(),
     'name' => get_the_title(),
     'address1' => get_field('address1'),
     'address2' => get_field('address2'),
     'address3' => get_field('address3'),
     'city' => get_field('city'),
     'zip' => get_field('zip'),
     'phone' => get_field('phone'),
     'email' => get_field('email'),
     'web' => get_field('web'),
     'stockist_id' => get_field('stockist_id'),
     'lat' => get_field('lat'),
     'lng' => get_field('lng')
   );

endwhile;

wp_reset_query();

// output

echo json_encode( $locations, JSON_PRETTY_PRINT );



?>
<?php
//get_footer();
