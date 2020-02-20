<?php
/**
 * Template Name: Retailer Main Page
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

  $retainerShowHide = get_field('retailer_area_showhide', 'option');

  include(locate_template("inc/retailer-area/login.php"));
  include(locate_template("inc/page-elements/title.php"));
  include(locate_template("inc/retailer-area/page-main/loggedin.php"));

  if ($retainerShowHide == 1 || is_user_logged_in()) :
    include(locate_template("inc/retailer-area/page-main/children.php"));
  endif;

?>

<?php
get_footer();
