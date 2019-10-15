<?php

/**
 * Template Name: UC Ranges Template
 */

get_header(); ?>

<?php
//override the_title() since we are in a taxonomy
$custom_title = 'Choose a Carpet';
include(locate_template("inc/page-elements/title.php"));
include(locate_template("inc/archive-ranges/filter_pagination.php"));
?>
<?php
$terms = get_terms(
  array(
    'taxonomy' => 'ranges',
    'hide_empty' => false
  )
);
foreach ($terms as $range) : ?>
  <?php $url = esc_attr(get_term_link($range->term_id)); ?>

  <a href="<?php echo $url; ?>">
    <?php $image = get_field('thumbnail', 'product_industrys_' . $range->term_id);
      if ($image) : ?>
      <img src="<?php echo $image['sizes']['equipment_thumb']; ?>" alt="<?php echo $image['alt']; ?>">
    <?php else : ?>

    <?php endif; ?>

    <h3><?php echo $range->name; ?></h3>

  </a>
<?php endforeach; ?>

<?php
get_footer();
