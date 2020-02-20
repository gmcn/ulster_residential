<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starting_Theme
 */

?>

<article class="col-sm-6 col-md-4 col-lg-3 search_children">
<?php $featimg = get_the_post_thumbnail_url($post->ID, 'medium');  ?>
	<div class="search_children__wrapper matchheight">
		<?php if ($featimg) : ?>
			<img class="imgmatchheight" src="<?php echo $featimg ?>" alt="<?php echo the_title(); ?>">
		<?php else : ?>
			<img class="imgmatchheight" src="<?php echo get_template_directory_uri(); ?>/images/placeholder.svg" alt="<?php echo the_title(); ?>">
		<?php endif; ?>


			<h2 class="hmatchheight"><?php echo the_title(); ?></h2>
			<p class="pmatchheight"><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?> &nbsp; </p>
			<a href="<?php echo the_permalink(); ?>">
				View More
			</a>
	</div>

</article>
