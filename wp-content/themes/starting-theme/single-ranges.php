<?php

/**
 * Template Name: Ranges (Single Carpet) Template
 *
 * Template for the ranges taxonomy on the UC website
 * @author Steve Hewitt
 *
 * @package Starting_Theme
 */

get_header(); ?>

<?php
//override the_title() since we are in a taxonomy
$custom_title = 'Choose A Carpet';
include(locate_template("inc/page-elements/title.php"));

$range_types = (get_the_terms($post->ID, 'ranges_type'));
$colors = (get_the_terms($post->ID, 'ranges_colour'));

include(locate_template("inc/archive-ranges/range_title.php"));
include(locate_template("inc/archive-ranges/single-range.php"));

include(locate_template("inc/archive-ranges/rest-of-range.php"));

?>

<?php
get_footer();
