<?php
$thumb['1x'] = get_the_post_thumbnail_url(get_the_ID(), 'square_thumbnail');

$imgdata = wp_get_attachment_image_src(get_post_thumbnail_id(), 'square_thumbnail-retina__center'); //change thumbnail to whatever size you are using
$wanted_dimensions = 800; //change this to your liking


if ($imgdata[1] > $wanted_dimensions && $imgdata[2] > $wanted_dimensions) {
    $thumb['2x'] = get_the_post_thumbnail_url(get_the_ID(), 'square_thumbnail-retina__center');
} else {
    unset($thumb['2x']);
}
$range_types = (get_the_terms(get_the_ID(), 'ranges_type'));
?>
<div class="l-thumbGrid__item">
    <div class="l-thumbGrid__item--overlay" href="<?php the_permalink(); ?>">
        <div class="singleRange--title">

          <?php if ( (get_the_title()) == $range_types[0]->name ) : ?>
            <h2><?php echo the_field('colour') ?></h2>
          <?php elseif ((get_field('colour') == get_the_title() ) && (get_the_title()) == get_the_title() ) : ?>
            <h2><?php echo the_field('colour') ?></h2>
          <?php else : ?>
            <h2><?php the_title(); ?> <?php echo the_field('colour') ?></h2>
          <?php endif; ?>



            <h3><?php echo $range_types[0]->name; ?></h3>
        </div>
        <!--<div class="singleRange--buttons">
            <?php if (inCart($_SESSION['cart'], get_the_ID())) : ?>
                <a href="javascript:void(0);" class="e-btn e-btn--black e-btn--addToCart" data-id="<?php the_ID(); ?>">This Sample is Already Added</a>
            <?php else : ?>
                <a href="#" class="e-btn e-btn--primary js-addToCart e-btn--addToCart" data-id="<?php the_ID(); ?>">Add this sample to My Basket</a>
            <?php endif; ?>
            <a href="<?php echo site_url('basket'); ?>" class="e-btn e-btn--grey e-btn--viewCart">View Cart &amp; Order Samples</a>
        </div>-->
        <div class="singleRange--info">
            <a href="<?php the_permalink(); ?>" class="e-btn e-btn--productInfo text-uppercase hidden-xs hidden-sm">
                <div>View product information</div><img src="<?php asset('/images/plus_sign.svg'); ?>">
            </a>
            <a href="<?php the_permalink(); ?>" class="e-btn e-btn--productInfo text-uppercase hidden-md hidden-lg">
                <div>View details</div><img src="<?php asset('/images/plus_sign.svg'); ?>">
            </a>
        </div>
    </div>
    <div class="l-thumbGrid__item--image"><?php echo swatchThumbnail(get_the_ID(), 'square_thumbnail'); ?></div>
    <img src="<?php bloginfo('template_directory'); ?>/images/transparent.png" alt="<?php the_title(); ?>">
</div>
