<?php
if (has_post_thumbnail()) {
    $thumb['1x'] = get_the_post_thumbnail_url(get_the_ID(), 'square_thumbnail');
    $thumb['2x'] = get_the_post_thumbnail_url(get_the_ID(), 'square_thumbnail_retina');
}
?>
<div class="l-thumbGrid__item" <?php if (!has_post_thumbnail()) {
                                    echo randomColor();
                                } ?>>
    <a href="<?php the_permalink(); ?>" class="archiveThumb">
        <div class="post__date"><?php echo get_the_date('d.m.y'); ?></div>
        <div class="post__title">
            <h2 class="u-ac"><?php the_title(); ?></h2>
        </div>
        <div class="post__link"><span>VIEW POST</span></div>
    </a>
    <?php if (has_post_thumbnail()) { ?>
        <img src="<?php echo $thumb['1x']; ?>" srcset="<?php echo $thumb['1x']; ?> 1x, <?php echo $thumb['2x']; ?> 2x" alt="<?php the_title(); ?>">
    <?php } else { ?>
        <img src="<?php bloginfo('template_directory'); ?>/images/transparent.png" alt="<?php the_title(); ?>">
    <?php } //end if post_thumbnail 
    ?>
</div>