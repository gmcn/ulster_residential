<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starting_Theme
 */

get_header();

$ranges_type = 'ranges_style'; // change to 1 for production
?>

<?php include(locate_template("inc/archive-ranges/taxonomy-content.php")); ?>

<?php
get_footer();
?>