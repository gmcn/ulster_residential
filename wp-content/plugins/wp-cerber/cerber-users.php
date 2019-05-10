<?php

add_action( 'personal_options', function ( $profileuser ) {

	if ( lab_lab() ) :

    ?>
    <tr>
        <th scope="row">
            <label for="cerber_user_2fa"><?php _e( 'Two-Factor Authentication', 'wp-cerber' ); ?>
            </label>
        </th>
        <td>
			<?php
			$cus      = cerber_get_set( 'cerber_user', $profileuser->ID );
			$selected = ( empty( $cus['tfm'] ) ) ? 0 : $cus['tfm'];
			echo cerber_select( 'cerber_user_2fa', array(
				0 => __( 'Determined by user role policies', 'wp-cerber' ),
				1 => __( 'Always enabled', 'wp-cerber' ),
				2 => __( 'Disabled', 'wp-cerber' ),
			), $selected );
			?>
        </td>
    </tr>

    <?php

    endif;

	if ( defined( 'IS_PROFILE_PAGE' ) && IS_PROFILE_PAGE ) {
		return;
	}
	$b     = crb_is_user_blocked( $profileuser->ID );
	$b_msg = ( ! empty( $b['blocked_msg'] ) ) ? $b['blocked_msg'] : '';
	$dsp   = ( ! $b ) ? 'display:none;' : '';
	?>
    <tr>
        <th scope="row"><?php _e( 'Block User', 'wp-cerber' ); ?></th>
        <td>
            <fieldset>
                <legend class="screen-reader-text">
                    <span><?php _e( 'User is not permitted to log into the website', 'wp-cerber' ) ?></span>
                </legend>
                <label for="crb_user_blocked">
                    <input name="crb_user_blocked" type="checkbox" id="crb_user_blocked"
                           value="1" <?php
				    checked( ( $b ) ? true : false ); ?> />
				    <?php _e( 'User is not permitted to log into the website', 'wp-cerber' );
				    if ( ! empty( $b['blocked_by'] ) ) {
					    if ( $b['blocked_by'] == get_current_user_id() ) {
						    $who = __( 'You', 'wp-cerber' );
					    }
					    else {
						    $user = get_userdata( $b['blocked_by'] );
						    $who  = $user->display_name;
						}
						$who = sprintf( _x( 'blocked by %s at %s', 'e.g. by John at 11:00', 'wp-cerber' ), $who, cerber_date( $b['blocked_time'] ) );
						echo ' - <i>' . $who . '</i>';
					}
					?>
                </label>
            </fieldset>

        </td>
    </tr>
    <tr id="crb_blocked_msg_row" style="<?php echo $dsp; ?>">
        <th scope="row"><?php _e( 'User Message', 'wp-cerber' ); ?></th>
        <td>
            <textarea placeholder="<?php _e( 'An optional message for this user', 'wp-cerber' ); ?>"
                      id="crb_blocked_msg" name="crb_blocked_msg"><?php echo htmlspecialchars( $b_msg ); ?></textarea>
        </td>
    </tr>
	<?php
	$pin = CRB_2FA::get_user_pin_info( $profileuser->ID );
	if ( $pin ) :
		?>
        <tr>
            <th scope="row"><?php _e( '2FA PIN Code', 'wp-cerber' ); ?></th>
            <td>
				<?php
				echo $pin;
				?>
            </td>
        </tr>
	<?php
	endif;

}, 1000 );

add_filter( 'user_contactmethods', function ( $methods, $user ) {

	if ( lab_lab() ) {
		$methods['cerber_2fa_email'] = __( 'Two-factor Authentication Email', 'wp-cerber' );
	}

	return $methods;
}, 0, 2 );

add_action( 'edit_user_profile_update', function ( $user_id ) {

	crb_admin_user2fa( $user_id );

	if ( $user_id == get_current_user_id() ) {
		return;
	}
	$b = absint( cerber_get_post( 'crb_user_blocked' ) );
	if ( ! $b ) {
		delete_user_meta( $user_id, CERBER_BUKEY );

		return;
	}
	$m = get_user_meta( $user_id, CERBER_BUKEY, 1 );
	if ( ! $m ) {
		$m            = array();
		$m['blocked'] = 0;
	}
	if ( $m['blocked'] != $b ) {
		$m['blocked']        = $b;
		$m[ 'u' . $user_id ] = $user_id;
		$m['blocked_by']     = get_current_user_id();
		$m['blocked_time']   = time();
		$m['blocked_ip']     = cerber_get_remote_ip();
	}
	$m['blocked_msg'] = strip_tags( stripslashes( $_POST['crb_blocked_msg'] ) );
	update_user_meta( $user_id, CERBER_BUKEY, $m );
} );

add_action( 'personal_options_update', 'crb_admin_user2fa' );

function crb_admin_user2fa( $user_id ) {
	$cus = cerber_get_set( 'cerber_user', $user_id );

	if ( ! $cus || ! is_array( $cus ) ) {
		$cus = array();
	}

	if ( ! isset( $_POST['cerber_user_2fa'] ) ) {
		return;
	}

	$cus['tfm'] = absint( $_POST['cerber_user_2fa'] );

	if ( ( $email = trim( cerber_get_post( 'cerber_2fa_email' ) ) ) ) {
		if ( is_email( $email ) ) {
			$cus['tfemail'] = $email;
		}
		else {
			add_action( 'user_profile_update_errors', function ( $errors ) {
				$errors->add( 'invalid-email', 'Invalid email address for Two-factor authentication' );
			} );
		}
	}
	else {
		$cus['tfemail'] = '';
	}

	cerber_update_set( 'cerber_user', $cus, $user_id );
	if ( $cus['tfm'] == 2 ) {
		CRB_2FA::delete_2fa( $user_id );
	}
}

add_filter( 'user_row_actions', 'crb_collect_uids', 10, 2 );
add_filter( 'ms_user_row_actions', 'crb_collect_uids', 10, 2 );
function crb_collect_uids( $actions, $user_object ) {
	crb_user_id_list( $user_object->ID );

	return $actions;
}

function crb_user_id_list( $uid = 0 ) {
	static $list = array();
	if ( $uid ) {
		$list[ $uid ] = $uid;
	}
	else {
		return $list;
	}
}

add_filter( 'views_users', function ( $views ) {
	global $wpdb;
	$c = cerber_db_get_var( 'SELECT COUNT(meta_key) FROM ' . $wpdb->usermeta . ' WHERE meta_key = "' . CERBER_BUKEY . '"' );
	$t = __( 'Blocked Users', 'wp-cerber' );
	if ( $c ) {
		$t = '<a href="users.php?crb_filter_users=blocked">' . $t . '</a>';
	}
	$views['cerber_blocked'] = $t . ' (' . $c . ')';

	return $views;
} );

add_filter( 'users_list_table_query_args', function ( $args ) {
	if ( isset( $_REQUEST['crb_filter_users'] ) ) {
		$args['meta_key']     = CERBER_BUKEY;
		$args['meta_compare'] = 'EXISTS';
	}

	return $args;
} );

function crb_format_user_name( $data ) {
	if ( $data->first_name ) {
		$ret = $data->first_name . ' ' . $data->last_name;
	}
	else {
		$ret = $data->display_name;
	}

	return $ret . ' (' . $data->user_login . ')';
}

// Bulk actions

add_filter( "bulk_actions-users", function ( $actions ) {
	$actions['cerber_block_users'] = __( 'Block', 'wp-cerber' );

	return $actions;
} );

add_filter( "handle_bulk_actions-users", function ( $url ) {
	if ( cerber_get_bulk_action() == 'cerber_block_users' ) {
		if ( $users = cerber_get_get( 'users' ) ) {
			foreach ( $users as $user_id ) {
				cerber_block_user( absint( $user_id ) );
			}
		}
		else {
			// 'No users selected';
		}
		$preserve = array( 's', 'paged', 'role', 'crb_filter_users' );
		$remove = array_diff(
			array_keys( crb_get_query_params() ),
			$preserve );
		$url    = remove_query_arg( $remove, $url );
	}

	return $url;
} );

function cerber_block_user( $user_id ) {
	if ( ! is_super_admin() ) {
		return;
	}
	if ( $user_id == get_current_user_id() ) {
		return;
	}
	$m = get_user_meta( $user_id, CERBER_BUKEY, 1 );
	if ( ! $m ) {
		$m            = array();
		$m['blocked'] = 0;
	}
	if ( $m['blocked'] != 1 ) {
		$m['blocked']        = 1;
		$m[ 'u' . $user_id ] = $user_id;
		$m['blocked_by']     = get_current_user_id();
		$m['blocked_time']   = time();
		$m['blocked_ip']     = cerber_get_remote_ip();
	}
	$m['blocked_msg'] = '';
	update_user_meta( $user_id, CERBER_BUKEY, $m );
}

function crb_admin_show_role_policies() {

	$roles = wp_roles();

	$tabs_config = array();
	$policies    = crb_get_settings( 'crb_role_policies' );

	foreach ( $roles->role_names as $role_id => $name ) {
		$tabs_config[ $role_id ] = array(
			'title'   => $name,
			//'desc'     => $info,
			'content' => crb_admin_role_form( $role_id, $policies[ $role_id ] ),
		);
	}

	crb_admin_show_vtabs( $tabs_config, __( 'Save All Changes', 'wp-cerber' ), array( 'cerber_admin_do' => 'update_role_policies' ) );

}

function crb_admin_role_form( $role_id, $values ) {

	$html = '<table class="form-table">';
	foreach ( crb_admin_role_config() as $section_id => $config ) {

	    foreach ( $config['fields'] as $field_id => $field ) {
		    $pro = ( isset( $field['pro'] ) && ! lab_lab() );

		    if ( empty( $field['disabled'] ) ) {
			    $field['disabled'] = ( crb_array_get( $field, 'disable_role' ) == $role_id );
		    }

		    if ( $field_id == '2famode' && $role_id == 'administrator' ) {
			    $field['disabled'] = ! cerber_2fa_checker();
		    }

		    $enabler = '';
		    if ( isset( $field['enabler'][0] ) ) {
			    $enabler .= ' data-enabler="crb-input-' . $role_id . '[' . $field['enabler'][0] . ']" ';
		    }
		    if ( isset( $field['enabler'][1] ) ) {
			    $enabler .= ' data-enabler_value="' . $field['enabler'][1] . '" ';
		    }

		    $s = ( $pro ) ? ' color: #888; ' : '';

		    // Enabling/disabling conditional inputs
		    $enabled = true;
		    if ( isset( $field['enabler'][0] ) ) {
			    $enab_val = crb_array_get( $values, $field['enabler'][0], '' );
			    if ( isset( $field['enabler'][1] ) ) {
				    if ( $enab_val != $field['enabler'][1] ) {
					    $enabled = false;
				    }
			    }
			    else {
				    if ( empty( $enab_val ) ) {
					    $enabled = false;
				    }
			    }
		    }

		    $tr_class = ( ! $enabled ) ? ' crb-disable-this' : '';

		    if ( ! empty( $field['disabled'] ) ) {
			    $tr_class .= ' crb-disabled';
		    }

		    if ( $field['type'] != 'html' ) {
			    $value = ( ! $pro ) ? crb_array_get( $values, $field_id, '' ) : '';
			    $html  .= '<tr class="' . $tr_class . '"><th scope="row" style="' . $s . '">' . $field['title'] . '</th><td>' . crb_admin_form_field( $field, $role_id . '[' . $field_id . ']', $value ) . '<i ' . $enabler . '></i></td></tr>';
		    }
		    else {
			    $t    = ( $pro && $field_id == '2fasmart' ) ? crb_admin_cool_features() : '';
			    $html .= '<tr class="' . $tr_class . '"><td colspan="2" style="padding-left: 0; ' . $s . '">' . $t . $field['title'] . '<i ' . $enabler . '></i></td></tr>';
		    }
		}

	}
	$html .= '</table>';

	return $html;
}

function crb_admin_form_field( $field, $name, $value, $id = '' ) {
	$label = crb_array_get( $field, 'label' );
	if ( ! $id ) {
		$id = 'crb-input-' . $name;
	}
	$atts = '';
	if ( $field['disabled']
	     || ( isset( $field['pro'] ) && ! lab_lab() ) ) {
		$atts = ' disabled ';
	}
	if ( $field['disabled'] ) {
		$value = '';
	}
	if ( isset( $field['placeholder'] ) ) {
		$atts .= ' placeholder="' . $field['placeholder'] . '"';
	}
	$style = '';
	if ( isset( $field['width'] ) ) {
		$style .= ' width:' . $field['width'];
	}
	switch ( $field['type'] ) {
		case 'checkbox':
			return cerber_checkbox( $name, $value, $label, $id, $atts );
			break;
		case 'select':
			return cerber_select( $name, $field['set'], $value, '', $id, '', '', null, $atts );
			break;
		case 'text':
		default:
			$type = crb_array_get( $field, 'type', 'text' );

			//return $pre . '<input type="' . $type . '" id="' . $id . '" name="' . $name . '" value="' . $value . '"' . $atts . ' class="' . $class . '" ' . $size . $maxlength . $atts . $data . ' />';
			return '<input style="'.$style.'" type="' . $type . '" id="' . $id . '" name="' . $name . '" value="' . $value . '" ' . $atts . ' />';
			break;
	}
}

function crb_admin_role_config() {
	return array(
		'access'    => array(
			'name'   => '',
			'desc'   => '',
			'fields' => array(
				'nodashboard' => array(
					'title'        => __( 'Block access to WordPress Dashboard', 'wp-cerber' ),
					'type'         => 'checkbox',
					'disable_role' => 'administrator',
				),
				'notoolbar' => array(
					'title' => __( 'Hide Toolbar when viewing site', 'wp-cerber' ),
					'type'  => 'checkbox',
				),
			)
		),
		'redirect' => array(
			'name'   => __( 'Redirection rules', 'wp-cerber' ),
			'desc'   => '',
			'fields' => array(
				'rdr_login'  => array(
					'title' => __( 'Redirect user after login', 'wp-cerber' ),
					'type'  => 'text',
					'width' => '100%',
				),
				'rdr_logout' => array(
					'title' => __( 'Redirect user after logout', 'wp-cerber' ),
					'type'  => 'text',
					'width' => '100%',
				),
			)
		),
		'misc' => array(
			'name'   => '',
			'desc'   => '',
			'fields' => array(
				'auth_expire' => array(
					'title'       => __( 'User session expiration time', 'wp-cerber' ),
					'placeholder' => 'minutes',
					'type'        => 'number',
				),
			)
		),
		'twofactor' => array(
			'name'   => __( 'Two-Factor Authentication', 'wp-cerber' ),
			'desc'   => '',
			'fields' => array(
				'2famode' => array(
					'title'    => __( 'Two-factor authentication', 'wp-cerber' ),
					'type'     => 'select',
					'set'      => array(
						0 => __( 'Disabled', 'wp-cerber' ),
						1 => __( 'Always enabled', 'wp-cerber' ),
						2 => __( 'Advanced mode', 'wp-cerber' )
					),
				),
				'2fasmart'         => array(
					'title'   => __( 'Enforce two-factor authentication if any of the following conditions is true', 'wp-cerber' ),
					'type'    => 'html',
					'enabler' => array( '2famode', 2 ),
					'pro'     => 1
				),
				'2fanewcountry' => array(
					'title'   => __( 'Login from a different country', 'wp-cerber' ),
					'type'    => 'checkbox',
					'enabler' => array( '2famode', 2 ),
					'pro'     => 1
				),
				'2fanewnet4'      => array(
					'title'   => __( 'Login from a different network Class C', 'wp-cerber' ),
					'type'    => 'checkbox',
					'enabler' => array( '2famode', 2 ),
					'pro'     => 1
				),
				'2fanewip'      => array(
					'title'   => __( 'Login from a different IP address', 'wp-cerber' ),
					'type'    => 'checkbox',
					'enabler' => array( '2famode', 2 ),
					'pro'     => 1
				),
				'2fanewua'      => array(
					'title'   => __( 'Using a different browser or device', 'wp-cerber' ),
					'type'    => 'checkbox',
					'enabler' => array( '2famode', 2 ),
					'pro'     => 1
				),
				'note2'         => array(
					'title'   => __( 'Enforce two-factor authentication with fixed intervals', 'wp-cerber' ),
					'type'    => 'html',
					'enabler' => array( '2famode', 2 ),
					'pro'     => 1
				),
				'2fadays'       => array(
					'title'   => __( 'Regular time intervals (days)', 'wp-cerber' ),
					'type'    => 'number',
					'label'   => __( 'days interval', 'wp-cerber' ),
					'enabler' => array( '2famode', 2 ),
					'pro'     => 12
				),
				'2falogins'     => array(
					'title'   => __( 'Fixed number of logins', 'wp-cerber' ),
					'type'    => 'number',
					'label'   => __( 'number of logins', 'wp-cerber' ),
					'enabler' => array( '2famode', 2 ),
					'pro'     => 1
				),

			)
		),
	);
}

function crb_admin_save_role_policies( $post ) {
	$roles    = wp_roles();
	$policies = array();
	foreach ( $roles->role_names as $role_id => $name ) {
		$policies[ $role_id ] = $post[ $role_id ];
	}

	array_walk_recursive( $policies, function ( &$element, $key ) {
		$element = trim( $element );

		if ( $key == 'rdr_logout' ) {
			if ( false !== strrpos( $element, 'wp-admin' ) ) {
				$element = '';
			}
		}
		if ( $element && in_array( $key, array( 'rdr_login', 'rdr_logout' ) ) ) {
			if ( substr( $element, 0, 4 ) != 'http'
			     && $element{0} != '/' ) {
				$element = '/' . $element;
			}
		}

		if ( ! is_array( $element )
		     && ! is_numeric( $element ) ) {
			$element = sanitize_text_field( (string) $element );
		}
	} );

	$settings = get_site_option( CERBER_SETTINGS );
	$settings['crb_role_policies'] = $policies;

	if ( update_site_option( CERBER_SETTINGS, $settings ) ) {
		cerber_admin_message( __( 'Policies have been updated', 'wp-cerber' ) );
	}
}