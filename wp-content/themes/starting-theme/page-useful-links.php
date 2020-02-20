<?php
/**
 * Template Name: Retailer Area Child Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starting_Theme
 */

get_header(); ?>

<?php
  include(locate_template("inc/page-elements/title.php"));
  include(locate_template("inc/retailer-area/content.php"));
  include(locate_template("inc/page-contact/useful-links.php"));
  include(locate_template("inc/retailer-area/price.php"));
  include(locate_template("inc/retailer-area/events.php"));
  include(locate_template("inc/retailer-area/installation.php"));
  include(locate_template("inc/retailer-area/back.php"));
?>

<?php
get_footer();
