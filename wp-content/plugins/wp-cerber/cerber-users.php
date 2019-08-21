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
						$who = sprintf( _x( 'blocked by %s at %s', 'e.g. blocked by John at 11:00', 'wp-cerber' ), $who, cerber_date( $b['blocked_time'] ) );
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
		$methods['cerber_2fa_email'] = __( 'Two-Factor Authentication Email', 'wp-cerber' );
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
	}
	else {
		cerber_block_user( $user_id, strip_tags( stripslashes( $_POST['crb_blocked_msg'] ) ) );
	}

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

function cerber_block_user( $user_id, $msg = '' ) {
	if ( ! is_super_admin() ) {
		return;
	}
	if ( $user_id == get_current_user_id() ) {
		return;
	}

	if ( ( $m = get_user_meta( $user_id, CERBER_BUKEY, true ) )
	     && ! empty( $m['blocked'] )
	     && $m[ 'u' . $user_id ] == $user_id ) {
		return;
	}

	if ( ! $m || ! is_array( $m ) ) {
		$m = array();
	}

	$m['blocked']        = 1;
	$m[ 'u' . $user_id ] = $user_id;
	$m['blocked_by']     = get_current_user_id();
	$m['blocked_time']   = time();
	$m['blocked_ip']     = cerber_get_remote_ip();
	$m['blocked_msg']    = $msg;

	update_user_meta( $user_id, CERBER_BUKEY, $m );
	crb_admin_destroy( $user_id );
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

/**
 * @param array|string $sids
 * @param int $user_id
 *
 * @return int
 */
function crb_admin_kill( $sids, $user_id = null ) {
	if ( ! is_super_admin() && ! nexus_is_valid_request() ) {
		return 0;
	}

	if ( ! is_array( $sids ) ) {
		$sids = array( $sids );
	}

	if ( ! $user_id ) {
		$users = cerber_db_get_col( 'SELECT user_id FROM ' . cerber_get_db_prefix() . CERBER_USS_TABLE . ' WHERE wp_session_token IN ("' . implode( '","', $sids ) . '")' );
	}
	else {
		$users = array( $user_id );
	}

	if ( ! $users || ! $sids ) {
		return 0;
	}

	$kill   = array_flip( $sids );
	$total  = 0;
	$errors = 0;

	// Prevent termination the current admin session
	if ( wp_get_session_token() ) {
		unset( $kill[ crb_admin_hash_token( wp_get_session_token() ) ] );
	}

	$before = cerber_db_get_var( 'SELECT COUNT(user_id) FROM ' . cerber_get_db_prefix() . CERBER_USS_TABLE );

	foreach ( $users as $user_id ) {
		$count = 0;

		$sessions = get_user_meta( $user_id, 'session_tokens', true );

		if ( empty( $sessions ) || ! is_array( $sessions ) ) {
			continue;
		}
		if ( ! $do_this = array_intersect_key( $kill, $sessions ) ) {
			continue;
		}

		foreach ( $do_this as $key => $nothing ) {
			unset( $sessions[ $key ] );
			unset( $kill[ $key ] );
			$count ++;
		}

		if ( $count ) {
			if ( update_user_meta( $user_id, 'session_tokens', $sessions ) ) {
				$total += $count;
			}
			else {
				$errors ++;
			}
		}
	}

	if ( $errors ) {
		cerber_admin_notice( 'Error: Unable to update user meta data.' );
	}

	if ( $total ) {
		cerber_admin_message( sprintf( _n( 'Session has been terminated', '%s sessions have been terminated', $total, 'wp-cerber' ), $total ) );

		// Workaround if user meta cache is out-of-sync with DB (like with WP Redis)
		$after = cerber_db_get_var( 'SELECT count(user_id) FROM ' . cerber_get_db_prefix() . CERBER_USS_TABLE );
		if ( $after == $before ) { // cache was not saved to DB
			cerber_sync_sessions();
		}
	}
	else {
		cerber_admin_notice( 'No sessions found.' );
		cerber_sync_sessions();
	}

	return $total;
}

function crb_admin_destroy( $user_id ) {
	if ( ! $user_id || get_current_user_id() == $user_id ) {
		return;
	}
	$manager = WP_Session_Tokens::get_instance( $user_id );
	$manager->destroy_all();
}

/**
 * Return a "session verifier" to identify the current admin session among others admin sessions
 *
 * Copy of WP_Session_Tokens->hash_token();
 *
 * @param $token
 *
 * @return string
 */
function crb_admin_hash_token( $token ) {
	// If ext/hash is not present, use sha1() instead.
	if ( function_exists( 'hash' ) ) {
		return hash( 'sha256', $token );
	} else {
		return sha1( $token );
	}
}

function crb_admin_is_current_session( $session_id ) {
	static $st = null;
	if ( $st === null ) {
		$st = wp_get_session_token();
	}

	return ( $session_id === crb_admin_hash_token( $st ) );
}

function crb_admin_get_user_cell( $user_id = null, $base_url = '', $text = '', $label = '' ) {
	static $roles, $user_cache = array(), $avatar_cache = array();

	if ( ! $user_id ) {
		return '';
	}

	if ( ! isset( $user_cache[ $user_id ] ) ) {
		$user_cache[ $user_id ] = get_userdata( $user_id );
	}

    if ( ! isset( $avatar_cache[ $user_id ] ) ) {
		$avatar_cache[ $user_id ] = get_avatar( $user_id, 32 );
	}

	if ( ! isset( $roles ) ) {
		$roles = wp_roles()->roles;
	}

	$ret = '';

	if ( $u = $user_cache[ $user_id ] ) {

		$r = '';
		if ( ! is_multisite() && $u->roles ) {
			$r = array();
			foreach ( $u->roles as $role ) {
				$r[] = $roles[ $role ]['name'];
			}
			$r = '<span class="act-role">' . implode( ', ', $r ) . '</span>';
		}

		$lbl = ( $label ) ? '<span class="crb-us-lbl">' . $label . '</span>' : '';

		if ( $base_url ) {
			$ret = '<a href="' . $base_url . '&amp;filter_user=' . $user_id . '"><b>' . $u->display_name . '</b></a>' . $lbl . '<p>' . $r . '</p>';
		}
		else {
			$ret = '<b>' . $u->display_name . '</b>' . $lbl . '<p>' . $r . '</p>';
		}

		$ret = '<div class="crb-us-name">' . $ret . '</div>';

		if ( $avatar = $avatar_cache[ $user_id ] ) {
			$avatar = '<td>' . $avatar . '</td>';
		}
		else {
			$avatar = '';
		}

		$ret = '<table class="crb-avatar"><tr>' . $avatar . '<td>' . $ret . $text . '</td></tr></table>';
	}

	return $ret;
}

function crb_admin_show_sessions() {

    // Helper for WP_List_Table URLs and navigation links
	if ( nexus_is_valid_request() ) {
	    // Add parameters
		$add = array( 'paged', 'order', 'orderby' );
		foreach ( $add as $param ) {
			if ( $val = crb_array_get( crb_get_query_params(), $param ) ) {
				$_REQUEST[ $param ] = $val;
				$_GET[ $param ] = $val;
			}
		}
		// Correct URL
		add_filter( 'set_url_scheme', function ( $url, $scheme, $orig_scheme ) {
			return cerber_admin_link( 'sessions' );
		}, 10, 3 );
	}

	echo '<form id="crb-user-sessions" method="post" action="">';
	cerber_nonce_field( 'control', true );
	echo '<input type="hidden" name="cerber_admin_do" value="crb_manage_sessions">';
	$slaves = new CRB_Sessions_Table();
	$slaves->prepare_items();
	//$slaves->search_box( 'Search', 'search_id' );
	$slaves->display();
	echo '</form>';
}

class CRB_Sessions_Table extends WP_List_Table {

	private $geo;

	public function __construct() {
		parent::__construct( array(
			'singular' => 'Session',
			'plural'   => 'Sessions',
			'ajax'     => false,
			'screen'   => 'cerber_user_sessions' // Without this it does not work
		) );

		$this->geo = lab_lab();
	}

	// Columns definition
	function get_columns() {
		return array(
			'cb'          => '<input type="checkbox" />', //Render a checkbox instead of text
			'ses_user'    => __( 'User', 'wp-cerber' ),
			//'ses_role'    => __( 'Role', 'wp-cerber' ),
			'ses_started' => __( 'Created', 'wp-cerber' ),
			'ses_expires' => __( 'Expires', 'wp-cerber' ),
			'ses_ip'      => '<div class="act-icon"></div>' . __( 'IP Address', 'wp-cerber' ),
			'ses_host'    => __( 'Host Info', 'wp-cerber' ),
			'ses_action'  => __( 'Action', 'wp-cerber' ),
		);
	}

	// Sortable columns
	function get_sortable_columns() {
		return array(
			'ses_user' => array( 'user_id', false ), // true means dataset is already sorted by ASC
			'ses_started' => array( 'started', false ),
			'ses_expires' => array( 'expires', false ),
			'ses_ip' => array( 'ip', false ),
		);
	}

	// Bulk actions
	function get_bulk_actions() {
		return array(
			'bulk_session_terminate' => __( 'Terminate session', 'wp-cerber' ),
			'bulk_block_user'        => __( 'Block user', 'wp-cerber' ),
		);
	}

	// Retrieve data from the DB

	function prepare_items() {
		global $wpdb;

		// These quires show the same perfomance
		//if ( cerber_db_get_var( 'SELECT user_id FROM ' . cerber_get_db_prefix() . CERBER_USS_TABLE . ' WHERE expires < ' . time() . ' LIMIT 1' ) ) {
		$min = cerber_db_get_var( 'SELECT MIN(expires) FROM ' . cerber_get_db_prefix() . CERBER_USS_TABLE );
		if ( ! $min || $min < time() ) {
			cerber_sync_sessions(); // full sync if there are expired sessions
		}
		else {
			cerber_sync_sessions( false ); // full sync if table is empty
		}

		$where       = array();
		$total_items = 0;
		$get = crb_get_query_params();

		// Sorting
		$orderby = crb_array_get( $get, 'orderby', 'started' );
		$order   = crb_array_get( $get, 'order', 'DESC' );
		$orderby = sanitize_sql_orderby( $orderby . ' ' . $order ); // !works only with fields, not tables references!
		$orderby = ' ORDER BY ' . $orderby . ' ';

		// Pagination, part 1, SQL
		$per_page = crb_admin_get_per_page();
		$current_page = $this->get_pagenum();
		if ( $current_page > 1 ) {
			$offset = ( $current_page - 1 ) * $per_page;
			$limit  = ' LIMIT ' . $offset . ',' . $per_page;
		}
		else {
			$limit = 'LIMIT ' . $per_page;
		}

		// Search
		if ( $term = cerber_get_get( 's' ) ) {
			$term = stripslashes( $term );
			$s    = '"%' . cerber_real_escape( $term ) . '%"';
			if ( preg_match( '/[^A-Z\d\-\/\.\:]/i', $term ) ) {
				// Mixing columns with different collations for non-latin symbols generates MySQL error
				$where[] = '';
			}
			else {
				$where[] = '';
			}
		}

		if ( $user_id = crb_array_get( $get, 'filter_user', 0, '\d+' ) ) {
			$where[] = 'user_id = ' . $user_id;
		}

		$where = ( ! empty( $where ) ) ? ' WHERE ' . implode( ' AND ', $where ) : '';

		// Retrieving data

		$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM ' . cerber_get_db_prefix() . CERBER_USS_TABLE . ' ses JOIN ' . $wpdb->users . ' us ON (ses.user_id = us.ID) ' . $where . $orderby . $limit;

		if ( $this->items = cerber_db_get_results( $query ) ) {
			$total_items = cerber_db_get_var( 'SELECT FOUND_ROWS()' );
		}

		if ( ! empty( $term ) ) {
			echo '<div style="margin-top:15px;"><b>' . __( 'Search results for:', 'wp-cerber' ) . '</b> “' . htmlspecialchars( $term ) . '”</div>';
		}

		// Pagination, part 2
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page'    => $per_page,
			'total_pages' => ceil( $total_items / $per_page )
		) );

	}

	public function single_row( $item ) {
		//$item['user_data'] = get_userdata( $item['user_id'] );
		parent::single_row( $item );
	}

	function column_cb( $item ) {
		if ( ! crb_admin_is_current_session( $item['wp_session_token'] ) ) {
			return '<input type="checkbox" name="ids[]" value="' . $item['wp_session_token'] . '" />';
		}

		return '';
	}

	/**
	 * @param array $item // not object!
	 * @param string $column_name
	 *
	 * @return string
	 */
	function column_default( $item, $column_name ) {
		global $crb_ajax_loader;
		//return $item[ $column_name ]; // raw output as is
		switch ( $column_name ) {
			case 'ses_user':

				$label = '';
				$links = '';

				if ( ! nexus_is_valid_request() ) {
					$links = $this->row_actions( array(
						'<a href="' . get_edit_user_link( $item['user_id'] ) . '">' . __( 'Profile', 'wp-cerber' ) . '</a>',
					) );

					$label = ( crb_admin_is_current_session( $item['wp_session_token'] ) ) ? __( 'You', 'wp-cerber' ) : '';
				}

				return crb_admin_get_user_cell( $item['user_id'], cerber_admin_link( 'sessions' ), $links, $label );

				break;
			case 'ses_started':

				$logins = cerber_activity_link( array( 5 ) ) . '&filter_user=' . $item['user_id'];
				$set  = array(
					'<a href="' . $logins . '">' . __( 'All Logins', 'wp-cerber' ) . '</a>',
					'<a href="' . cerber_admin_link( 'activity' ) . '&filter_user=' . $item['user_id'] . '">' . __( 'User Activity', 'wp-cerber' ) . '</a>'
				);

				$url = '';
				// TODO: make it via AJAX per user row with a click "Details"
				if ( $item['session_id'] ) {
					/*$log = cerber_db_get_row( 'SELECT * FROM ' . CERBER_LOG_TABLE . ' WHERE session_id = "' . $item['session_id'] . '"' );
					if ( $log ) {
						$det = explode( '|', $log['details'] );
						$url = $det[4];
					}*/
				}

				return '<span title="' . $url . '">' . cerber_date( $item['started'] ) . '</span>' . $this->row_actions( $set );

				break;
			case 'ses_expires':
				return cerber_date( $item['expires'] );
				break;
			case 'ses_ip':

				$set = array(
					'<a href="' . cerber_admin_link( 'activity' ) . '&filter_ip=' . $item['ip'] . '">' . __( 'Activity', 'wp-cerber' ) . '</a>',
					'<a href="' . cerber_admin_link( 'traffic' ) . '&filter_ip=' . $item['ip'] . '">' . __( 'Traffic', 'wp-cerber' ) . '</a>'
				);

				return crb_admin_ip_cell( $item['ip'], '', $this->row_actions( $set ) );

				break;
			case 'ses_host':
				$ip_id   = cerber_get_id_ip( $item['ip'] );
				$ip_info = cerber_get_ip_info( $item['ip'], true );
				if ( ! $hostname = crb_array_get( $ip_info, 'hostname_html' ) ) {
					$hostname = '<img data-ip-id="' . $ip_id . '" class="crb-no-hostname" src="' . $crb_ajax_loader . '" />' . "\n";
				}
				$country = ( $this->geo ) ? '<p style="">' . crb_country_html( $item['country'], $item['ip'] ) . '</p>' : '';

				return $hostname . $country;
				break;
			case 'ses_action':
				if ( crb_admin_is_current_session( $item['wp_session_token'] ) ) {
					return '';
				}

				$href = wp_nonce_url( cerber_admin_link( 'sessions' ) . '&cerber_admin_do=terminate_session&id=' . $item['wp_session_token'] . '&user_id=' . $item['user_id'], 'control', 'cerber_nonce' );
				$confirm = 'onclick="return confirm(\'' . __( 'Are you sure?', 'wp-cerber' ) . '\')"';

				return '<a href="' . $href . '" ' . $confirm . '">' . __( 'Terminate', 'wp-cerber' ) . '</a></br>';

				break;
		}

		return '';
	}

	function no_items() {
		if ( ! empty( $_GET['s'] ) ) {
			parent::no_items();
		}
		else {
			echo 'No user sessions found.';
		}
	}
}