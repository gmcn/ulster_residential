<?php 
/**
 * Loop through all carpet ranges as a grid
 *
 * @package Starting_Theme
 *
 */
?>
<?php  if(have_posts()):?>
<div class="l-thumbGrid">
    <?php while(have_posts()):the_post();?>
        <?php 
            $thumb['1x'] = get_the_post_thumbnail_url(get_the_ID(),'square_thumbnail');
            $thumb['2x'] = get_the_post_thumbnail_url(get_the_ID(),'square_thumbnail_retina');
        ?>
        <div class="l-thumbGrid__item">
            <a href="<?php the_permalink();?>">
                <h2 class="u-ac"><?php the_title();?></h2>
            </a>
            <img src="<?php echo $thumb['1x'];?>" srcset="<?php echo $thumb['1x'];?> 1x, <?php echo $thumb['2x'];?> 2x" alt="<?php the_title();?>">
        </div>
        
    <?php endwhile;?>
</div>
<?php endif;?>