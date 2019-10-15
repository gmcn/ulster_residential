<?php $current_user = wp_get_current_user(); ?>

<?php if ( 0 == $current_user->ID ) : ?>
<?php else : ?>

  <div class="container-fluid loggedin">
    <div class="row">

    <div class="col-md-6 loggedin_account_no hidden-xs hidden-sm">
      Account # <?php echo $current_user->account_no ?>
    </div>

    <div class="col-md-6">
      <h2>Retailer Utilities</h2>
    </div>

    <hr />

    <div class="col-md-6 loggedin_account_no hidden-md hidden-lg">
      Account # <?php echo $current_user->account_no ?>
    </div>

    <div class="col-md-3">
      <p>Account Name </p>
      <div class="input">
        <?php echo $current_user->display_name; ?>
      </div>
    </div>

    <div class="col-md-3">
      <p>Address</p>
      <div class="input">
        <?php echo $current_user->company_address ?>
      </div>

    </div>

    <div class="col-md-6">
      <p>Email</p>
      <div class="input">
        <?php echo $current_user->user_email  ?>
      </div>
    </div>

    </div>
    <p class="edit">To edit your details please email: <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a></p>

    <hr />

    <div class="row">
      <div class="col-md-5 col-md-offset-6 pre-reailer_children">
        CLICK AN AREA BELOW TO FIND OUT MORE
      </div>
    </div>
  </div>
<?php endif; ?>
