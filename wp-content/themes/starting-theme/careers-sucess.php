<?php

/**
 * Template Name: Careers - Success Page
 *
 */
get_header(); ?>

<?php
include(locate_template("inc/page-elements/title.php"));
?>
<?php

$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

?>

<div class="container-fluid basket basket__success u-bg--light_grey u-mb--2" style="background: url(<?php echo $featured_img_url ?>) center center no-repeat; background-size: cover;">
  <div class="row">
    <div class="col-sm-12 u-pt--6 u-pb--6">
      <h1 class="u-mb--4"><?php the_title(); ?></h1>
      <div class="basket__sucess--content u-bt--d u-bb--d  u-pt--4 u-pb--4">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>

<?php
get_footer();
