<?php
/**
 * Template Name: Front Page
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
  include(locate_template("inc/page-front/hero.php"));
  include(locate_template("inc/page-front/welcome.php"));
  include(locate_template("inc/page-front/cta.php"));
  include(locate_template("inc/page-front/newsletter.php"));
  include(locate_template("inc/page-elements/stockists.php"));
?>

<?php
//get_sidebar();
get_footer();
