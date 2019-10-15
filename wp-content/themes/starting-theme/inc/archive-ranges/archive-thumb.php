<div class="l-thumbGrid__item" <?php if (!$thumb) {
                                    echo randomColor();
                                } ?>>
    <a href="<?php echo $url; ?>" class="archiveThumb is-category">
        <div class="category__space"></div>
        <div class="category__title">
            <h2 class="u-ac"><?php echo $range->name; ?></h2>
        </div>
        <div class="category__link"><span>VIEW PRODUCT RANGE</span></div>
    </a>
    <?php if ($thumb) { ?>
        <img src="<?php echo $thumb['sizes']['square_thumbnail']; ?>" srcset="<?php echo $thumb['sizes']['square_thumbnail']; ?> 1x, <?php echo $thumb['sizes']['square_thumbnail-retina']; ?> 2x" alt="<?php $range->name; ?>">
    <?php } else { ?>
        <img src="<?php bloginfo('template_directory'); ?>/images/transparent.png" alt="<?php the_title(); ?>">
    <?php } //end if post_thumbnail 
    ?>
</div>