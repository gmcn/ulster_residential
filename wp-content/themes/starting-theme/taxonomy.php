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



$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
$ranges_type = $term->taxonomy;


?>

<?php include(locate_template("inc/archive-ranges/taxonomy-content.php")); ?>


<?php
get_footer();
?>