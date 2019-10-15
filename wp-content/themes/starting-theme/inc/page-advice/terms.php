<div class="col-md-6 terms bordermatch">
  <div class="row">
  <h2>Carpet Terms</h2>
  </div>

  <?php if( have_rows('carpet_terms') ): ?>

  	<?php $i = 1; while( have_rows('carpet_terms') ): the_row();

  		// vars
  		$term = get_sub_field('term');
  		$description = get_sub_field('description');

  		?>
      <div class="row term">
      	<div class="col-xs-3 col-md-2 terms_count matchheight">
          #<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?>
        </div>

        <div class="col-xs-9 col-md-10 terms_content matchheight">
          <p><?php echo $term ?></p>
          <p><?php echo $description ?></p>
        </div>
      </div>

  	<?php $i++; endwhile; ?>
  <?php endif; ?>

  <div class="row social">
    <h2>Further Information</h2>
    <!-- <div class="social_details"> -->
      <div class="col-xs-3 col-md-2 social_details_border matchheight">

      </div>

      <div class="col-xs-9 col-md-10 social_details matchheight">
        <p>For further info please contact: </p>
        <a href="mailto:marketing@ulstercarpets.com">marketing@ulstercarpets.com</a>
        <div class="social_icons">
          <a href="https://www.instagram.com/ulstercarpets/" target="_blank">
            <img src="<?php echo
get_template_directory_uri(); ?>/images/instagram_icon_purple.svg" alt="Follow us on Instagram">
          </a>
          <a href="https://www.facebook.com/UlsterCarpets" target="_blank">
            <img src="<?php echo
get_template_directory_uri(); ?>/images/facebook_icon_purple.svg" alt="Follow us on Facebook">
          </a>
          <a href="https://twitter.com/UlsterCarpets" target="_blank">
            <img src="<?php echo
get_template_directory_uri(); ?>/images/twitter_icon_purple.svg" alt="Follow us on Twitter">
          </a>
          <a href="https://www.pinterest.co.uk/UlsterCarpets/" target="_blank">
            <img src="<?php echo
get_template_directory_uri(); ?>/images/pinterest_icon_purple.svg" alt="Follow us on Pinterest">
          </a>
          <a href="https://www.linkedin.com/company/ulster-carpets/" target="_blank">
            <img src="<?php echo
get_template_directory_uri(); ?>/images/linkedin_icon_purple.svg" alt="Follow us on Linkedin">
          </a>
        </div>
      </div>
    <!-- </div> -->
  </div>
</div>
