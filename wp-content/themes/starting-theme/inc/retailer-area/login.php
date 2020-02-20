<!-- login form -->
<?php
global $user_login;
// In case of a login error.
if ( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) : ?>
  <div class="aa_error">
  <p><?php _e( 'FAILED: Try again!', 'AA' ); ?></p>
  </div>
<?php endif;

// If user is already logged in.
if ( is_user_logged_in() ) : ?>

<?php
// If user is not logged in.
else: ?>

  <div class="logincontainer">

    <div class="vert-align">

      <div class="loginwrapper">

        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-6 loginwrapper_signin">

              <span>Sign In</span>

              <h1>SIGN IN PLEASE</h1>

              <?php

              // Login form arguments.
              $args = array(
              'echo'           => true,
              'redirect'       => get_site_url() . '/retailer-area/',
              'form_id'        => 'loginform',
              'label_username' => __( 'Account #' ),
              'label_password' => __( 'Password' ),
              'label_remember' => __( 'Remember Me' ),
              'label_log_in'   => __( 'Continue' ),
              'id_username'    => 'user_login',
              'id_password'    => 'user_pass',
              'id_remember'    => 'rememberme',
              'id_submit'      => 'wp-submit',
              'remember'       => true,
              'value_username' => NULL,
              'value_remember' => true
              );

              // Calling the login form.
              wp_login_form( $args );

              ?>
            </div>
            <div class="col-xs-6 loginwrapper_signup">

              <span>Sign Up</span>

              <p class="intro">Please enter your info below to request an access account for our Retailer Sign In Section.</p>

              <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 6, 'title' => false, 'description' => false ) ); ?>

            </div>
          </div>

          <div class="row">
            <div class="col-12 loginwrapper_footer">
              <img src="<?php echo get_template_directory_uri(); ?>/images/login-from_footer.jpg" alt="">
            </div>
          </div>
        </div>

        <a class="exit" href="/">X</a>

      </div><!-- /loginwrapper -->
    </div><!-- /vert-align -->
  </div><!-- /logincontainer -->
<?php endif; ?>


 <!-- /login form -->
