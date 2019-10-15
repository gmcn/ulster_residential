<?php
/**
 * The template for displaying tag pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starting_Theme
 */
get_header(); ?>


<?php
	include(locate_template("inc/page-elements/title.php"));
	// include(locate_template("inc/blog/filter_pagination.php"));
	include(locate_template("inc/page-blog/loop.php"));
?>


<?php get_footer(); ?>
