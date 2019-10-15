<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Starting_Theme
 */

get_header(); ?>

<?php
  include(locate_template("inc/page-elements/title.php"));
  include(locate_template("inc/page-gallery/ulsterathome.php"));
?>

<?php
get_footer();
