<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starting_Theme
 */

?>

<article class="row about_children">
	<div class="col-md-12">
		<h2><?php echo the_title(); ?></h2>
	</div>
	<div class="col-md-12">
		<?php the_excerpt(); ?>
		<a href="<?php echo the_permalink(); ?>">
			View More
		</a>
	</div>
</article>
