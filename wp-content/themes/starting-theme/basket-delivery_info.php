<?php
if (cartCount() == 0) {
  wp_redirect('basket');
}

if ($_POST) {
  $validation = cartValidation();
  if ($validation['result'] == true) {
    //passed validation process the order
    cartProcessOrder();
  }
} else {
  //set validation as null to avoid
  $validation = null;
}
/**
 * Template Name: Basket - Delivery Information
 *
 */

get_header();
?>

<?php
$custom_title = 'Basket';
include(locate_template("inc/page-elements/title.php"));
?>
<?php

$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

?>
<div class="container-fluid basket basket__samples u-bg--light_grey u-pt--2 u-pb--4 u-mb--2">
  <div class="row u-pb--1">
    <div class="col-sm-12 u-mb--4  ">
      <h1>Delivery<br />Information</h1>
    </div>
    <div class="col-sm-4">
      <?php the_content(); ?>
    </div>
    <div class="col-sm-7 col-sm-offset-1">
      <?php $activeProgress = 'delivery'; ?>
      <?php include(locate_template("inc/basket/deliveryProgressBar.php")); ?>
    </div>
  </div>
  <hr class="u-bt--d">
  <form method="POST">
    <div class="row u-pt--1">
      <?php if (isset($validation['result'])) : ?>
        <div class="col-sm-12">
          <div class="u-bg--red u-pt--2 u-pl--2 u-pr--2 u-pb--1 u-mb--2">
            <p class="u-text--white">One or more fields on the form contain errors, please correct them and try again</p>
          </div>
        </div>
      <?php endif; ?>
      <div class="col-sm-4">
        <div class="form_group">
          <input type="text" class="form-control <?php isValid('form_first_name', $validation); ?>" name="form_first_name" id="first_name" placeholder="First Name">
        </div>
        <div class="form_group">
          <input type="text" class="form-control form-control <?php isValid('form_last_name', $validation); ?>" name="form_last_name" id="last_name" placeholder="Last Name">
        </div>
        <div class="form_group">
          <input type="text" class="form-control form-control <?php isValid('form_company', $validation); ?>" name="form_company" id="company" placeholder="Company (If Applicable)">
        </div>
        <div class="form_group">
          <input type="text" class="form-control form-control <?php isValid('form_telephone', $validation); ?>" name="form_telephone" id="telephone" placeholder="Telephone">
        </div>
        <div class="form_group">
          <input type="email" class="form-control form-control <?php isValid('form_email', $validation); ?>" name="form_email" id="email" placeholder="Email" required>
        </div>
      </div>

      <div class="col-sm-8">
        <div class="form_group">
          <input type="text" class="form-control form-control <?php isValid('form_address_1', $validation); ?>" name="form_address_1" id="address_1" placeholder="Address Line 1">
        </div>
        <div class="form_group">
          <input type="text" class="form-control form-control <?php isValid('form_address_2', $validation); ?>" name="form_address_2" id="address_2" placeholder="Address Line 2">
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="form_group">
              <input type="text" class="form-control form-control <?php isValid('form_city', $validation); ?>" name="form_city" id="city" placeholder="City">
            </div>
            <div class="form_group">
              <?php include(locate_template("inc/basket/countryDropdown.php")); ?>
            </div>
          </div>
          <div class="col-sm-7">
            <div class="form_group">
              <input type="text" class="form-control form-control <?php isValid('form_county', $validation); ?>" name="form_county" id="county" placeholder="County">
            </div>
            <div class="form_group">
              <input type="text" class="form-control form-control <?php isValid('form_postcode', $validation); ?>" name="form_postcode" id="postcode" placeholder="Postcode">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="form_group">
              <div class="frm_checkbox"><label for="form_marketing"><input type="checkbox" name="form_city" id="marketing" value="Please tick this if you would like us to contact you by email for updates and marketing material." data-invmsg="Checkboxes is invalid"> Please tick this if you would like us to contact you by email for updates and marketing material.</label></div>
            </div>
          </div>
          <div class="col-sm-3">
            <a href="<?php echo site_url('privacy-policy'); ?>" class="u-text--700 u-text--dark_grey u-text--small">View our data policy</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row text-right">
      <div class="col-sm-12">
        <hr class="u-bt--d">

        <button type="submit" class="e-btn e-btn--silver e-btn--has-radius u-pl--4 u-pr--4 text-uppercase u-text--white">Submit &#x25BA;</button>
      </div>
    </div>

  </form>
</div>

<?php
get_footer();
