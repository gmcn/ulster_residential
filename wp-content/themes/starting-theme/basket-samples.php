<?php

/**
 * Template Name: Basket - Samples / Cart
 *
 */

get_header(); ?>

<?php
$custom_title = 'Basket';
include(locate_template("inc/page-elements/title.php"));
?>


<div class="container-fluid basket basket__samples u-bg--light_grey u-pt--2 u-pb--4 u-mb--2">
  <div class="row">
    <div class="col-sm-12 u-mb--4  ">
      <h1>My Samples</h1>
    </div>
    <div class="col-sm-4">
      <?php the_content(); ?>
    </div>
    <div class="col-sm-7 col-sm-offset-1">
      <?php $activeProgress = 'samples'; ?>
      <?php include(locate_template("inc/basket/deliveryProgressBar.php")); ?>
    </div>
  </div>
  <?php $cart = fetchCart();
  $count = 0;
  if ($cart && $cart->have_posts()) :
    ?>
    <table class="text-left">
      <?php

        while ($cart->have_posts()) : $cart->the_post();
          $count++;
          $range_types = (get_the_terms($post->ID, 'ranges_type'));
          $colors = (get_the_terms($post->ID, 'ranges_colour'));
          ?>

        <tr id="<?php the_ID(); ?>">
          <td>
            <h3>#0<?php echo $count; ?></h3>
          </td>
          <?php if (isset($range_types)) : ?>
            <td><small>Range</small><br><?php echo $range_types[0]->name; ?></td>

          <?php endif; ?>
          <td><?php echo swatchThumbnail(get_the_ID(), 'small_thumbnail'); ?></td>
          <td><small>Design</small><br><?php the_title(); ?></td>
          <td><small>Colour</small><br><?php if (get_field('color')) {
                                              the_field('color');
                                            } else {
                                              listRangeColors($colors);
                                            } ?></td>
          <td><small>Design No.</small><br><?php the_field('design_no'); ?></td>
          <td><a href="<?php the_permalink(); ?>" class="e-btn e-btn--blue e-btn--has-radius text-uppercase u-text--white">Product Details</a><a href="#" class="e-btn e-btn--red e-btn--has-radius js-removeCart text-uppercase u-text--white u-ml--1" data-id="<?php the_ID(); ?>">Delete this sample</a></td>
        </tr>
      <?php
        endwhile; // endwhile
        wp_reset_postdata();
        ?>

    </table>

    <div class="row js-nextButton">
      <div class="col-sm-12 text-right">
        <a href="delivery" class="e-btn e-btn--silver text-uppercase e-btn--has-radius u-text--white u-pl--3 u-pr--3">Continue &#x25BA;</a>
      </div>
    </div>
  <?php endif; ?>
  <div class="row js-basketEmpty" <?php if ($cart && $cart->have_posts()) { ?>style="display:none;" <?php } ?>>
    <div class="col-sm-12 u-mt--6 u-mb--6">
      <h2>Your basket is empty, <a href="/ranges">click here</a> to explore our ranges to choose your samples.</h2>
    </div>
  </div>

</div>

<?php
get_footer();
?>
