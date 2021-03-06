<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starting_Theme
 */

?>

	</div><!-- #content -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<footer class="container-fluid">
		<div class="row hidden-xs hidden-sm">
			<!-- choose a carpet -->
			<div class="col-xs-6 col-sm-4 col-md-2 menu_wrapper matchheight">
				<p>Choose a carpet</p>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer-choose' ) );
					?>
			</div>
			<!-- blog -->
			<div class="col-xs-6 col-sm-4 col-md-2 menu_wrapper matchheight">
				<p>Blog</p>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer-blog' ) );
					?>
			</div>
			<!-- advice -->
			<div class="col-xs-6 col-sm-4 col-md-2 menu_wrapper matchheight">
				<p>Advice</p>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer-advice' ) );
					?>
			</div>
			<!-- find a stockist -->
			<div class="col-xs-6 col-sm-4 col-md-2 menu_wrapper matchheight">
				<p>Find a stockist</p>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer-stockist' ) );
					?>
			</div>
			<!-- about -->
			<div class="col-xs-6 col-sm-4 col-md-2 menu_wrapper matchheight">
				<p>About</p>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer-about' ) );
					?>
			</div>
			<!-- Gallery -->
			<div class="col-xs-6 col-sm-4 col-md-2 menu_wrapper matchheight">
				<p>Gallery</p>
				<?php wp_nav_menu( array(
					'theme_location' => 'footer-gallery' ) );
					?>
			</div>
		</div>
		<div class="container-fluid signature clear">
			<div class="col-md-2">
				<a class="site-branding" href="<?php site_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="<?php bloginfo( 'name' ); ?>">	</a>
				<div class="social hidden-md hidden-lg">
					<a href="https://www.instagram.com/ulstercarpets/" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/instagram_icon.svg" alt="Instagram"></a>
					<a href="https://www.facebook.com/UlsterCarpets" target="_blank"> <img src="<?php echo get_template_directory_uri() ?>/images/facebook_icon.svg" alt="Facebook"></a>
					<a href="https://twitter.com/UlsterCarpets" target="_blank"> <img src="<?php echo get_template_directory_uri() ?>/images/twitter_icon.svg" alt="Twitter"></a>
					<a href="https://www.pinterest.co.uk/UlsterCarpets/" target="_blank"> <img src="<?php echo get_template_directory_uri() ?>/images/pinterest_icon.svg" alt="Pinterest"></a>
					<a href="https://www.linkedin.com/company/ulster-carpets/?originalSubdomain=uk" target="_blank"> <img src="<?php echo get_template_directory_uri() ?>/images/linkedin_icon.svg" alt="Linkedin"></a>
				</div>
			</div>

			<div class="col-md-4 col-lg-6 copyright hidden-xs hidden-sm">
				© <?php echo date('Y'); ?> Ulster Carpets  |  <a href="<?php echo get_site_url(); ?>/modern-slavery-statement/">Modern Slavery Statement</a> | <a href="<?php echo get_site_url(); ?>/gender-pay-gap/">Gender Pay Gap</a> | <a href="<?php echo get_site_url(); ?>/terms-and-conditions/">Terms & Conditions</a> | <a href="<?php echo get_site_url(); ?>/privacy-policy/">Privacy Policy</a> | <a href="<?php echo get_site_url(); ?>/cookie-policy/">Cookie Policy</a>
				<p class="byline">
					Website by <a href="https://cornellstudios.com" target="_blank">Cornell</a>
				</p>
			</div>

			<div class="col-md-6 col-lg-4 links">

				<a class="hidden-xs hidden-sm" href="https://ulstercarpets.com/contract">Contract Site</a>
				<a href="<?php echo get_site_url(); ?>/contact">Contact Us</a>

				<div class="social hidden-xs hidden-sm">
					<a href="https://www.instagram.com/ulstercarpets/" target="_blank">
						<img src="<?php echo get_template_directory_uri() ?>/images/instagram_icon.svg" alt="Instagram">
					</a>
					<a href="https://www.facebook.com/UlsterCarpets" target="_blank">
						<img src="<?php echo get_template_directory_uri() ?>/images/facebook_icon.svg" alt="Facebook">
					</a>
					<a href="https://twitter.com/UlsterCarpets" target="_blank">
						<img src="<?php echo get_template_directory_uri() ?>/images/twitter_icon.svg" alt="Twitter">
					</a>
					<a href="https://www.pinterest.co.uk/UlsterCarpets/" target="_blank">
						<img src="<?php echo get_template_directory_uri() ?>/images/pinterest_icon.svg" alt="Pinterest">
					</a>
					<a href="https://www.linkedin.com/company/ulster-carpets/?originalSubdomain=uk" target="_blank">
						<img src="<?php echo get_template_directory_uri() ?>/images/linkedin_icon.svg" alt="Linkedin">
					</a>
				</div>

			</div>

			<div class="col-md-4 col-lg-6 copyright hidden-md hidden-lg">
				© <?php echo date('Y'); ?> Ulster Carpets  |  <a href="<?php echo get_site_url(); ?>/modern-slavery-statement">Modern Slavery Statement</a> | <a href="<?php echo get_site_url(); ?>/gender-pay-report">Gender Pay Gap</a> | <a href="<?php echo get_site_url(); ?>/terms-and-conditions/">Terms & Conditions</a> | <a href="<?php echo get_site_url(); ?>/privacy-policy/">Privacy Policy</a> | <a href="<?php echo get_site_url(); ?>/cookie-policy/">Cookie Policy</a>

				<p class="byline">
					Website by <a href="https://cornellstudios.com" target="_blank">Cornell</a>
				</p>

			</div>

		</div>
	</footer><!-- footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
