<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starting_Theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
<link type="text/plain" rel="robots" href="/robots.txt" />
<link type="text/plain" rel="author" href="/humans.txt" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'starting-theme' ); ?></a>

	<header>

		<!-- Static navbar -->
	      <nav class="navbar navbar-default">
	        <div class="container-fluid">

						<div class="row">
							<div class="col-xs-5 col-md-4">
								<div class="navbar-header">
			            <button type="button" class="navbar-toggle collapsed hidden-xs hidden-sm" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			              <span class="sr-only">Toggle navigation</span>
			              <span class="icon-bar"></span>
			              <span class="icon-bar"></span>
			              <span class="icon-bar"></span>
			            </button>
									<?php $description = get_bloginfo( 'description', 'display' ); ?>
									<a class="site-branding" href="/"><img src="<?php echo get_template_directory_uri() ?>/images/logo.svg" alt="<?php bloginfo( 'name' ); ?> | <?php echo $description; /* WPCS: xss ok. */ ?>">	</a>
			          </div>
							</div>
							<div class="col-md-4 hidden-xs hidden-sm" style="text-align: center">
								<?php wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'menu_id' => 'navbar',
									'container_id' => 'navbar',
									'container_class' => 'navbar-collapse collapse',
									'menu_class' => 'navbar-collapse',
									'items_wrap' => '<ul id="" class="nav navbar-nav navbar-right">%3$s</ul>' ) );
									?>
							</div>
							<div class="col-xs-7 col-md-4" style="text-align: right">
								<div class="row">
									<div class="col-md-6 social hidden-xs hidden-sm">
										<a href="https://www.instagram.com/ulstercarpets/" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/instagram_icon.svg" alt="Instagram"></a>
										<a href="https://www.facebook.com/UlsterCarpets" target="_blank"> <img src="<?php echo get_template_directory_uri() ?>/images/facebook_icon.svg" alt="Instagram"></a>
										<a href="https://twitter.com/UlsterCarpets" target="_blank"> <img src="<?php echo get_template_directory_uri() ?>/images/twitter_icon.svg" alt="Twitter"></a>
										<a href="https://www.pinterest.co.uk/UlsterCarpets/" target="_blank"> <img src="<?php echo get_template_directory_uri() ?>/images/pinterest_icon.svg" alt="Pinterest"></a>
										<a href="https://www.linkedin.com/company/ulster-carpets/?originalSubdomain=uk" target="_blank"> <img src="<?php echo get_template_directory_uri() ?>/images/linkedin_icon.svg" alt="Linkedin"></a>
									</div>
									<div class="col-md-6 icons">
										<span onclick="openNewsletter()">
												<img src="<?php echo get_template_directory_uri() ?>/images/newsletter.svg" alt="e-newsletter signup (find out first)">
										</span>
										<span onclick="openSearch()">
												<img src="<?php echo get_template_directory_uri() ?>/images/search_icon.svg" alt="Search our site">
										</span>
										<span class="hiddennav" onclick="openNav()">
											<!-- <div class="vert-align"> -->
												<img src="<?php echo get_template_directory_uri() ?>/images/hamburger_img.svg" alt="Open Navigation">
											<!-- </div> -->
										</span>
										<span>
												<a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/shopping_cart_head.svg" alt="Samples Cart"></a>
										</span>
									</div>
								</div>

							</div>
						</div>

	        </div><!--/.container-fluid -->
	      </nav><!-- #site-navigation -->

				<!-- The overlay -->
				<div id="mySearch" class="overlay">

				  <!-- Button to close the overlay navigation -->
				  <a href="javascript:void(0)" class="closebtn" onclick="closeSearch()">&times;</a>

				  <!-- Overlay content -->
				  <div class="container overlay-content">
						<h2>search our site</h2>
							<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">

								<div class="row">
									<div class="col-md-9">
										<input class="search-input-box" type="text" name="s" value="" placeholder="enter search keywords" maxlength="50" required="required" />
									</div>
									<div class="col-md-3">
										<button type="submit">Search</button>
									</div>
								</div>

							</form>

					</div>

				</div>

				<!-- The overlay -->
				<div id="myNewsletter" class="overlay">

				  <!-- Button to close the overlay navigation -->
				  <a href="javascript:void(0)" class="closebtn" onclick="closeNewsletter()">&times;</a>

				  <!-- Overlay content -->
				  <div class="container overlay-content">

						<!-- Begin Mailchimp Signup Form -->
						<div id="mc_embed_signup">
							<form action="https://ulstercarpets.us1.list-manage.com/subscribe/post?u=d3094e0ddbb7e0e873eac0a4e&amp;id=f6acdcf166" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<!-- <div id="mc_embed_signup_scroll"> -->
									<h2>e-newsletter signup <span>(find out first)</span></h2>
									<div class="row">
										<div class="col-md-6">
											<div class="mc-field-group">
												<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="YOUR EMAIL: example@domain.com">
											</div>
										</div>
										<div class="col-md-4 consent">
											<input type="checkbox" value="1" name="group[2621][1]" id="mce-group[2621]-2621-0"><label for="mce-group[2621]-2621-0">Please tick this if you would like us to contact  you by email for updates and marketing material.</label>
										</div>
										<div class="col-md-2">
											<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_d3094e0ddbb7e0e873eac0a4e_f6acdcf166" tabindex="-1" value=""></div>
											<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
										</div>
									</div>

									<!-- <div class="mc-field-group">
										<label for="mce-FNAME">First Name </label>
										<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
									</div>
									<div class="mc-field-group">
										<label for="mce-LNAME">Last Name </label>
										<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
									</div> -->
									<div id="mce-responses" class="clear">
										<div class="response" id="mce-error-response" style="display:none"></div>
										<div class="response" id="mce-success-response" style="display:none"></div>
									</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->

								<!-- </div> -->
							</form>
							<a class="policy" href="<?php echo site_url() ?>/privacy-policy">View our privacy policy</a>
						</div>

						<!--End mc_embed_signup-->

				  </div>

				</div>

				<div id="mySidenav" class="sidenav">

					<div class="row options">
						<div class="col-xs-5">
							<a href="#" onclick="openSearch()"><img src="<?php echo get_template_directory_uri() ?>/images/search_icon_white.svg" alt="Search"></a>
						</div>
						<div class="col-xs-2 closebtn_wrapper">
							<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><img src="<?php echo get_template_directory_uri() ?>/images/close_icon.svg" alt="Close"></a>
						</div>
						<div class="col-xs-5">
							<a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/shopping_cart.svg" alt="Basket"></a>
						</div>
					</div>


					<?php wp_nav_menu( array(
						'theme_location' => 'hidden-menu',
						'menu_class' => 'accordion' ) );
						?>

						<?php echo get_search_form(); ?>

						<?php echo wp_login_form(); ?>

				</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
