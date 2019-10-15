<?php
/**
 * Template Name: Colour Coordination Page
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
  include(locate_template("inc/page-coordination/content.php"));
  include(locate_template("inc/page-coordination/brochures.php"));
  include(locate_template("inc/page-coordination/trends.php"));
  include(locate_template("inc/page-coordination/children.php"));
  include(locate_template("inc/page-coordination/blog.php"));
  include(locate_template("inc/page-coordination/back.php"));
?>

<?php
get_footer();
