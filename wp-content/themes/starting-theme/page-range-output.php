<?php
/**
 * Template Name: Range Output Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starting_Theme
 */

//get_header(); ?>

<?php
$query = new WP_Query(array(
  'post_type' => 'ranges',
  'post_status' => 'publish',
  'posts_per_page' => -1
));

while ($query->have_posts()) {
  $query->the_post();
  $post_id = get_the_ID();
  echo '"' . get_the_title() . '",';
  echo '"' . get_field('design_no') . '",';
  echo '"';
  $colours = get_the_terms($post_id, 'ranges_colour');

  if ($colours) {
    foreach ($colours as $colour) {
      echo $colour->name . ',';
    }
  }
  echo '"<br>';
}

wp_reset_query();
?>
