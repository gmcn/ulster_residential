<?php $current_user = wp_get_current_user(); ?>

<?php if ( 0 == $current_user->ID ) : ?>
<?php else : ?>

  <div class="container-fluid loggedin">
    <div class="row">

    <div class="col-md-12 loggedin_account_no">
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
        <?php echo $current_user->user_email ?>
      </div>

    </div>

    <div class="col-md-6">
      <p>Email</p>
      <div class="input">
        <?php echo $current_user->user_email  ?>
      </div>
    </div>



    </div>
  </div>
<?php endif; ?>
