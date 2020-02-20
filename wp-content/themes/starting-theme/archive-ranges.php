<?php

/**
 * Template Name: Ranges Template
 *
 * Template for the ranges taxonomy on the UC website
 * @author Steve Hewitt
 *
 * @package Starting_Theme
 */

get_header(); ?>

<?php
global $post;
if (is_object($post)) {
  $slug = $post->post_name;
} else {
  $slug = 'range';
}
switch ($slug) {
  case 'style':
    $ranges_type = 'ranges_style';
    break;
  case 'colour':
    $ranges_type = 'ranges_colour';
    break;
  default:
    $ranges_type = 'ranges_type';
    break;
}

//override the_title() since we are in a taxonomy
// $custom_title = 'Choose A Range';
include(locate_template("inc/page-elements/title.php"));
include(locate_template("inc/archive-ranges/filter_pagination.php"));
?>
  <div class="categories">
    <div class="l-thumbGrid <?php echo $ranges_type; ?>">
      <?php

      $terms = get_terms(
        array(
          'taxonomy' => $ranges_type,
          'hide_empty' => false
        )
      );

      foreach ($terms as $range) :
        $thumb = get_field('category_thumbnail', $ranges_type . '_' . $range->term_id);
        $url = get_term_link($range->term_id);
        include(locate_template("inc/archive-ranges/archive-thumb.php"));

      endforeach; ?>
    </div>
  </div>
  <?php
  get_footer();
