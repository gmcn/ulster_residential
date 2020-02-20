<table>
  <tr>
    <th>id</th>
    <th>name</th>
    <th>address1</th>
    <th>address2</th>
    <th>address3</th>
    <th>city</th>
    <th>zip</th>
    <th>phone</th>
    <th>email</th>
    <th>web</th>
    <th>stockist_id</th>
    <th>latitude</th>
    <th>longitude</th>
  </tr>
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

//the loop
while ( $loop->have_posts() ) : $loop->the_post(); ?>

<tr>
  <td><?php echo get_the_ID(); ?></td>
  <td><?php echo get_the_title(); ?></td>
  <td><?php echo get_field('address1'); ?></td>
  <td><?php echo get_field('address2'); ?></td>
  <td><?php echo get_field('address3'); ?></td>
  <td><?php echo get_field('city'); ?></td>
  <td><?php echo get_field('zip'); ?></td>
  <td><?php echo get_field('phone'); ?></td>
  <td><?php echo get_field('email'); ?></td>
  <td><?php echo get_field('web'); ?></td>
  <td><?php echo get_field('stockist_id'); ?></td>
  <td><?php echo get_field('lat'); ?></td>
  <td><?php echo get_field('lng'); ?></td>
</tr>

<?php endwhile; wp_reset_query(); ?>

</table>

<?php
//get_footer();
