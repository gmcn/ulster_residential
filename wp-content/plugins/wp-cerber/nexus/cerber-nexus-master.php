<?php
/*
	Copyright (C) 2015-19 CERBER TECH INC., http://cerber.tech
	Copyright (C) 2015-19 CERBER TECH INC., https://wpcerber.com

    Licenced under the GNU GPL.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

/*

*========================================================================*
|                                                                        |
|	       ATTENTION!  Do not change or edit this file!                  |
|                                                                        |
*========================================================================*

*/


if ( ! defined( 'WPINC' ) ) { exit; }

define( 'CRB_ADD_SLAVE_LNK', '#TB_inline?width=450&height=350&inlineId=crb-popup-add-slave' );

function nexus_show_slaves() {
	//load_nexus_test_slaves();
	echo '<form id="crb-nexus-sites" method="get" action="">';
	wp_nonce_field( 'control', 'cerber_nonce' );
	echo '<input type="hidden" name="page" value="' . esc_attr( $_REQUEST['page'] ) . '">';
	echo '<input type="hidden" name="cerber_admin_do" value="nexus_site_table">';
	$slaves = new CRB_Slave_Table();
	$slaves->prepare_items();
	$slaves->search_box( 'Search', 'search_id' );
	$slaves->display();
	echo '</form>';
}

function nexus_show_slave_form( $site_id ) {
	$site = nexus_get_slave_data( $site_id );
	if ( ! $site ) {
		echo 'Website not found. <a href="' . cerber_admin_link( 'nexus_sites' ) . '">Return to the list</a>.';

		return;
	}

	$p = __( 'Select an existing group or enter a new one to add it', 'wp-cerber' );

	// We utilize WP settings API routines just to render the edit form

	$edit_fields = array(
		'main'    => array(
			'name' => __( 'Website Properties', 'wp-cerber'),
			//'info'   => __( 'User related settings', 'wp-cerber' ),
			'fields' => array(
				'site_id'   => array(
					'value' => $site->id,
					'type'  => 'hidden',
					'title' => '',
				),
				'site_url'  => array(
					'title'    => __( 'Website URL', 'wp-cerber' ),
					'value'    => $site->site_url,
					'disabled' => true,
				),
				'site_name' => array(
					'title'     => __( 'Display as', 'wp-cerber' ),
					'label'     => 'Original website name: ' . $site->site_name_remote,
					'value'     => $site->site_name,
					'required'  => true,
					'maxlength' => 200
				),
				'site_group' => array(
					'id'          => 'crb-select2-tags',
					'class'       => 'crb-wide',
					'title'       => __( 'Group', 'wp-cerber' ),
					'set'         => nexus_get_groups(),
					'value'       => $site->group_id,
					'type'        => 'select',
					'label'       => $p,
					'placeholder' => $p
				),
				'site_notes' => array(
					'title'     => __( 'Notes', 'wp-cerber' ),
					'value'     => $site->site_notes,
					'type'      => 'textarea',
					'maxlength' => 1000
				),
			)
		),
		'owner' => array(
			'name'   => __( 'Website Owner', 'wp-cerber' ),
			//'info'   => __( 'User related settings', 'wp-cerber' ),
			'fields' => array(
				'first_name'    => array(
					'title'     => __( 'First Name' ),
					'maxlength' => 100
				),
				'last_name'     => array(
					'title'     => __( 'Last Name' ),
					'maxlength' => 100
				),
				'owner_email'   => array(
					'title'     => __( 'Email' ),
					'maxlength' => 100
				),
				'owner_phone'   => array(
					'title'     => __( 'Phone', 'wp-cerber' ),
					'maxlength' => 100,
				),
				'owner_biz'   => array(
					'title'     => __( 'Company', 'wp-cerber' ),
					'maxlength' => 200,
				),
				'owner_address' => array(
					'title'     => __( 'Address', 'wp-cerber' ),
					'maxlength' => 200
				),
			)
		),
	);

	foreach ( $edit_fields['owner']['fields'] as $key => &$f ) {
		$f['value'] = crb_array_get( $site->details, $key );
	}

	cerber_wp_settings_setup( 'slave-edit-form', $edit_fields );
	cerber_show_settings_form( 'slave-edit-form' );
}

function nexus_get_groups( $clean_up = false ) {
	if ( ! $groups = cerber_get_set( 'nexus_groups' ) ) {
		$groups = array( 'Default' );
	}
	if ( $clean_up ) {
		$used = cerber_db_get_col( 'SELECT DISTINCT group_id FROM ' . cerber_get_db_prefix() . CERBER_MS_TABLE );
		if ( $used ) {
			// Deleting not used group
			$groups = array_intersect_key( $groups, array_flip( array_intersect( array_keys( $groups ), $used ) ) );
			cerber_update_set( 'nexus_groups', $groups );
		}
		else {
			cerber_delete_set( 'nexus_groups' );
		}
	}

	return $groups;
}

add_action( 'setup_theme', function () {
	if ( ! is_admin() || ! nexus_is_master() ) {
		return;
	}
	nexus_set_context();
	if ( nexus_get_context() ) {
		nexus_send_admin_request();
	}
}, 0 );

add_action( 'admin_init', function () {

	if ( nexus_is_master() && function_exists( 'nexus_schedule_refresh' ) ) {
		nexus_schedule_refresh();
	}

	if ( ! is_super_admin() ) {
		return;
	}

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		nexus_ajax_router();
	}

	if ( nexus_get_context() ) {
		add_action( 'admin_notices', 'cerber_show_admin_notice', 999 );
		add_action( 'network_admin_notices', 'cerber_show_admin_notice', 999 );
	}

	// Some tricks to obtain form data via WP settings API
	register_setting( 'cerberus-slave-edit-form', 'cerber-slave-edit-form' );
	add_filter( 'pre_update_option_cerber-slave-edit-form', function ( $value, $old_value, $option ) {
		// $slave is sanitized

		$group_id = 0;
		if ( ! empty( $value['site_group'] ) ) {
			$groups = nexus_get_groups();
			if ( is_numeric( $value['site_group'] ) ) {
				$group_id = (int) $value['site_group'];
			}
			if ( ! $group_id || ! isset( $groups[ $group_id ] ) ) {
				// Add new group
				$new = strip_tags( $value['site_group'] );
				if ( $new ) {
					$groups   = nexus_get_groups();
					$groups[] = $new;
					end( $groups );
					$group_id = key( $groups );
					cerber_update_set( 'nexus_groups', $groups );
				}
			}
		}

		$value['group_id'] = $group_id;
		nexus_update_slave( $value['site_id'], $value );

		return '';
	}, 10, 3 );



/*if ( ! is_admin() || ! $slave = nexus_get_context() ) {
	return;
}*/

} );

function nexus_add_slave( $token ) {
	if ( ! is_super_admin() || ! nexus_is_master() ) {
		return;
	}
	$token = trim( $token );
	if ( ( ! $t = nexus_the_token( $token ) )
	     || empty( $t[0] )
	     || empty( $t[1] )
	     || empty( $t[2] )
	     || empty( $t[3] )
	     || empty( $t[4] )
	     || empty( $t[5] )
	     || empty( $t[6] )
	) {
		cerber_admin_notice( __( 'Security access token is invalid', 'wp-cerber' ) );

		return;
	}

	// Subdir install? Add slash to avoid 301 redirection
	if ( strpos( substr( $t[5], strpos( $t[5], '.' ) ), '/' ) ) {
		$url = rtrim( $t[5], '/' ) . '/';
	}
	else {
		$url = $t[5];
    }

	$no_https = ( 'https://' !== substr( $url, 0, 8 ) ) ? true : false;

	$data                     = array();
	$data['site_pass']        = $t[0];
	$data['site_echo']        = $t[1];
	$data['x_field']          = $t[2];
	$data['x_num']            = $t[3];
	// These are shown in the dashboard, make them safe
	$data['site_url']         = substr( esc_url( $url ), 0, 250 );
	$data['site_name']        = mb_substr( htmlspecialchars( htmlspecialchars_decode( $t[6] ) ), 0, 250 );
	$data['site_name_remote'] = $data['site_name'];

	$data = array_map( function ( $e ) {
		return '"' . cerber_real_escape( $e ) . '"';
	}, $data );

	if ( cerber_db_get_var( 'SELECT id FROM ' . cerber_get_db_prefix() . CERBER_MS_TABLE . ' WHERE site_url = ' . $data['site_url'] ) ) {
		cerber_admin_notice( __( 'The website you are trying to add is already in the list', 'wp-cerber' ) );
	}

	if ( ! cerber_db_insert( cerber_get_db_prefix() . CERBER_MS_TABLE, $data ) ) {
		cerber_admin_notice( 'Unable to add website' );
	}
	else {
		$site_id = cerber_db_get_var( ' SELECT LAST_INSERT_ID()' );
		$edit = cerber_admin_link( 'nexus_sites', array( 'site_id' => $site_id ) );
		cerber_admin_message( __( 'The website has been added successfully', 'wp-cerber' )
                              . '&nbsp; [ <a href="' . $edit . '">' . __( 'Click to edit', 'wp-cerber' ) . '</a> | '
		                      . ' <a href="' . wp_nonce_url( cerber_admin_link() . '&cerber_admin_do=nexus_switch&nexus_site_id=' . $site_id, 'control', 'cerber_nonce' ) . '">' . __( 'Switch to the Dashboard', 'wp-cerber' ) . '</a> ]' );
		if ( $no_https ) {
			//cerber_admin_notice( __( 'Note: No SSL encryption is enabled on the website this can lead to data leakage.', 'wp-cerber' ) );
			cerber_admin_notice( __( 'Keep in mind: You have added the website that does not support SSL encryption. This may lead to data leakage.', 'wp-cerber' ) );
		}

		cerber_bg_task_add( array( 'func' => 'nexus_send', 'args' => array( array( 'type' => 'hello' ), $site_id ) ), true );
	}

}

/**
 * @param $id int Slave ID
 * @param $data array Sanitized slave data
 *
 * @return bool|mysqli_result|resource
 */
function nexus_update_slave( $id, $data ) {

	$id = absint( $id );
	if ( ! $id ) {
		return false;
	}

	$old = nexus_get_slave_data( $id );

	// Details
	if ( ! is_array( $old->details ) ) {
		$old->details = array();
	}
	$details_fields   = array( 'first_name', 'last_name', 'owner_email', 'owner_phone', 'owner_biz', 'owner_address' );
	$data['details'] = serialize( array_replace( $old->details, array_intersect_key( $data, array_flip( $details_fields ) ) ) );

	// Name is always stored in escaped form!
	if ( isset( $data['site_name'] ) ) {
		$data['site_name'] = htmlspecialchars( $data['site_name'] );
	}

	// 1. Numbers
	$int_columns = array( 'group_id', 'site_status', 'updates', 'refreshed', 'last_scan', 'last_http');
	$update      = array_map( function ( $e ) {
		return absint( $e );
	}, array_intersect_key( $data, array_flip( $int_columns ) ) );

	// 2. Escaping strings
	$str_columns = array( 'site_name', 'details', 'site_notes', 'plugin_v', 'wp_v' );
	$update      = array_merge( $update,
		array_map( function ( $e ) {
			return cerber_real_escape( $e );
		}, array_intersect_key( $data, array_flip( $str_columns ) ) ) );

	// SQL clause
	$fields = array();
	foreach ( $update as $field => $value ) {
		$fields[] = $field . '="' . $value . '"';
	}
	$sql_fields = implode( ',', $fields );

	if ( cerber_db_query( 'UPDATE ' . cerber_get_db_prefix() . CERBER_MS_TABLE . ' SET ' . $sql_fields . ' WHERE id = ' . $id ) ) {
		nexus_get_groups( true );
		return true;
	}

	return false;
}

/**
 * @param $site_id
 *
 * @return bool|object
 */
function nexus_get_slave_data( $site_id ) {
	$site_id = absint( $site_id );
	$site = cerber_db_get_row( 'SELECT * FROM ' . cerber_get_db_prefix() . CERBER_MS_TABLE . ' WHERE id = ' . $site_id, MYSQL_FETCH_OBJECT );
	if ( ! $site ) {
		return false;
	}
	if ( ! empty( $site->details ) ) {
		$site->details = unserialize( $site->details );
	}

	return $site;
}

function nexus_get_slaves( $args ) {
	$order = '';
	if ( isset( $args['orderby'] ) ) {
		$order = ' ORDER BY ' . $args['orderby'] . ' ';
	}
	if ( isset( $args['order'] ) ) {
		$order .= $args['order'];
	}

	return cerber_db_get_results( 'SELECT * FROM ' . cerber_get_db_prefix() . CERBER_MS_TABLE . $order, MYSQL_FETCH_OBJECT );
}

/**
 * @param $ids integer|array
 *
 * @return bool
 */
function nexus_delete_slave( $ids ) {
	if ( ! is_super_admin() ) {
		return false;
	}
	/*$field = ( ! $bulk ) ? 'site_id' : 'ids';
	if ( ! $ids = cerber_get_get( $field ) ) {
		return false;
	}*/

	if ( ! is_array( $ids ) ) {
		$ids = array( $ids );
	}

	$ids = array_map( function ( $e ) {
		return absint( $e );
	}, $ids );

	$ret = cerber_db_query( 'DELETE FROM ' . cerber_get_db_prefix() . CERBER_MS_TABLE . ' WHERE id IN (' . implode( ',', $ids ) . ')' );

	if ( $ret ) {
		$num = cerber_db_get_var( 'SELECT ROW_COUNT()' );
		cerber_admin_message( sprintf( _n( 'Website has been deleted', '%s websites have been deleted', $num, 'wp-cerber' ), $num ) );
		return true;
	}
	else {
		cerber_admin_notice( 'Unable to delete website' );
		return false;
	}
}

function nexus_get_back_link() {
	return cerber_admin_link( crb_admin_get_tab(), array( 'page' => crb_admin_get_page() ), true ) . '&cerber_admin_do=nexus_switch&nexus_site_id=0';
}

// ======================================================================================

function nexus_show_remote_page() {

    /* This code for new settings mechanism

	$slave = nexus_get_context();
	if ( cerber_is_http_post()
		 && ( $m = cerber_get_post( 'cerber_nexus_seal' ) )
		 && sha1( $slave->id . '|' . get_current_user_id() ) === $m ) {
		$response = nexus_send( array(
			'type' => 'submit',
			'data' => array(
				'post' => $_POST,
			)
		) );
	}
	else {
		$response = nexus_send( array(
			'type' => 'get_page',
			'data' => array(
			)
		) );
	}*/

    // An old, two steps version
    // TODO: remove the second step after upgrading Cerber's settings mechanism to a new version

	if ( cerber_is_http_post()
	     && ( nexus_seal( crb_array_get( $_POST, 'cerber_nexus_seal', 'none' ) ) ) ) {
		$response = nexus_send( array(
			'type' => 'submit',
			'data' => array(
				'post' => $_POST,
			)
		) );
	}

	// A separate request to render the page cause settings cache is updated now
	$response = nexus_send( array(
		'type' => 'get_page'
	) );

	echo $response;
}

function nexus_send_admin_request() {
	if ( empty( $_GET['cerber_admin_do'] )
	     || ( empty( $_GET['cerber_nonce'] )
	          && empty( $_POST['cerber_nonce'] ) ) ) {
		return;
	}
	$response = nexus_send( array(
		'type' => 'manage'
	) );
}

function nexus_ajax_router() {
    //return;

    if ( empty( $_REQUEST['action'] )
	     || empty( $_REQUEST['ajax_nonce'] ) ) {
		return;
	}

	if ( ! nexus_is_master()
	     || ! nexus_get_context()
	     || ! crb_admin_allowed_ajax( $_REQUEST['action'] )
	     || ! is_user_logged_in()
    ) {
		return;
	}

	check_ajax_referer( 'crb-ajax-admin', 'ajax_nonce' );

	$response = nexus_send( array(
		'type'  => 'ajax',
		//'cache' => false,
		'data'  => array(
			'post' => $_POST,
		)
	) );

	if ( is_wp_error( $response ) ) {
		nexus_diag_log( 'NETWORK ERROR: ' . $response->get_error_message() );
	}
	else {
		echo $response;
	}

	exit;
}

/**
 * @param $request array
 * @param $slave_id int
 *
 * @return bool|mixed
 */
function nexus_send( $request, $slave_id = null ) {
    global $nexus_last_http, $nexus_last_curl, $nexus_slave_name, $nexus_slave_id;

	nexus_diag_log( '/\/ Initiating ' . $request['type'] . ' request to the slave' . ( ( $slave_id ) ? ' #' . $slave_id : ' from context' ) );

	$slave  = ( $slave_id ) ? nexus_get_slave_data( $slave_id ) : nexus_get_context();

	if ( ! $slave ) {
		return false;
	}

	$network = nexus_net_send_request( $request, $slave );

	nexus_update_slave( $slave->id, array( 'last_http' => $nexus_last_http ) );
	$nexus_slave_id = $slave->id;
	$nexus_slave_name = $slave->site_name;

	if ( ! is_wp_error( $network ) ) {

		nexus_process_extra( $network, $slave );

		if ( ! empty( $network['payload']['error'] ) ) { // A critical error on the slave
			$m = 'An error occurred on ' . $slave->site_name . ': ' . htmlspecialchars( $network['payload']['error'][1] );
			cerber_admin_notice( $m );
			nexus_diag_log( $m );
			return '';
		}

		$response = $network['payload'];

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return $response;
		}

		if ( isset( $response['redirect'] ) ) {
			if ( $redirect_to = crb_array_get( $response, 'redirect_url' ) ) {
				nexus_diag_log( '> > > Redirecting to ' . $redirect_to );
				// TODO should we use wp_safe_redirect()???
				header( 'Location: ' . $redirect_to, true, 302 );
				exit;
			}
			else {
				cerber_safe_redirect( crb_array_get( $response, 'remove_args' ) );
			}
		}

		return $response;
	}
	else {

		$codes = array(
			301 => 'Unexpected HTTP redirection on the slave. Check if WP Cerber is installed and active on the slave website.',
			302 => 'Unexpected HTTP redirection on the slave. Check if WP Cerber is installed and active on the slave website.',
			403 => 'Access to the slave website is denied.',
			500 => 'Remote website (web server) is unable to proceed due to a fatal software (PHP) error. Check the server error log on the slave website.'
		);

		$causes = array(
			'A security plugin on the slave website is interfering with the WP Cerber plugin',
			'A directive in the .htaccess file on the slave website is blocking incoming requests',
			'A firewall or a proxy service (like Cloudflare) is blocking (filtering out) incoming requests to the slave website',
			'The IP address of this master is locked out or in the Black Access List on the slave website',

			'The slave mode on the remote website has been re-enabled making the security token saved on this master invalid',
			'The slave mode has been disabled on the remote website',
			'The IP address of this master website does not match the one set in the slave settings on the remote website',
			'The WP Cerber plugin has been deactivated on the slave website',

			'The remote server is redirecting incoming requests to another website',
			'The domain name of the slave website has been changed',

			'The remote server is down or not responding',
			'The SSL certificate of the slave website is expired or invalid',
            'There is no network connectivity between this master server and the server on which the slave website is running',
		);

		$kb = array(
			// 200
			'json_error'     => array( 4, 5, 1, 6, 7 ),
			'checksum_error' => array( 4 ),

			// Not 200
			0                => array( 8, 9, 10, 11, 12 ),
			301              => array( 8, 9, 11 ),
			302              => array( 8, 9, 11 ),
			403              => array( 0, 1, 2, 3 ),
		);

		if ( $network->get_error_code() == 'http_error' ) {
			if ( ! $error = crb_array_get( $codes, $nexus_last_http ) ) {
				$desc  = $nexus_last_http . ' ' . get_status_header_desc( $nexus_last_http );
				$error = '<a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/' . $nexus_last_http . '" target="_blank">' . $desc . '</a>';
			}
			else {
				$error = $nexus_last_http . ' ' . $error;
			}
			$error = 'HTTP ERROR ' . $error;
		}
		else {
			$error = $network->get_error_message();
		}

		nexus_diag_log( 'NETWORK ERROR: ' . $error );

		$parse  = parse_url( $slave->site_url );
		$domain = $parse['host'];
		$ip     = gethostbyname( $domain );

		?>
        <div style="padding: 4em;">

            <h3><?php _e( 'Invalid response from the slave website', 'wp-cerber' ); ?></h3>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
            Website: <?php echo $slave->site_name; ?><br/>
            Website URL: <?php echo $slave->site_url; ?><br/>
            <p style="font-weight: bold;">This may be caused by a number of reasons</p>
            <ul style="list-style: disc;">
				<?php

				if ( ! $kb_filter = crb_array_get( $kb, $network->get_error_code() ) ) {
					if ( ! $kb_filter = crb_array_get( $kb, $nexus_last_http ) ) {
						$kb_filter = null;
					}
				}

				$show = array();
				if ( $kb_filter ) {
					foreach ( $kb_filter as $key ) {
						$show[] = $causes[ $key ];
					}
					//$show = array_intersect_key( $causes, array_flip( $kb_filter ) );
				}

				if ( ! $show ) {
					$show = $causes;
				}

				echo '<li>' . implode( '</li><li>', $show ) . '</li>';

				?>
            </ul>

            <?php
			$slave = nexus_get_context();
			if ( $slave ) {
				echo '<p><a href="' . nexus_get_back_link() . '">Switch back to the master website</a></p>';
				echo '<p><a href="' . $slave->site_url . '/wp-admin/admin.php?page=cerber-nexus" target="_blank">Check the slave settings on ' . $slave->site_name . '</a></p>';
			}
            ?>

            <p style="margin-top: 2em;">Diagnostic information</p>
            <p class="code" style="font-size: 90%">
                HTTP code: <?php echo $nexus_last_http; ?><br/>
                Response size: <?php echo $nexus_last_curl['size_download']; ?><br/>
                IP address: <?php echo $ip; ?><br/>
                Hostname: <?php echo gethostbyaddr( $ip ); ?><br/>
		        <?php

		        foreach ( $nexus_last_curl as $key => $val ) {
			        if ( is_scalar( $val ) ) {
				        echo $key . ': ' . htmlspecialchars( $val );
			        }
			        else {
				        echo $key . ': ';
				        print_r( $val );
			        }
			        echo '<br/>';
		        }
		        ?>
                </p>
        </div>
		<?php
	}

	return false;
}

function nexus_process_extra( $data, $slave ) {

	$update = array();

	$v = $data['extra']['versions'];
	if ( $slave->plugin_v != $v[0] ) {
		$update['plugin_v'] = $v[0];
	}
	if ( $slave->wp_v != $v[1] ) {
		$update['wp_v'] = $v[1];
	}

	if ( $nums = crb_array_get( $data['payload'], 'numbers' ) ) {

		$update['refreshed'] = time();

		$u = $nums['updates']['plugins'] + $nums['updates']['wp'];
		if ( $slave->updates != $u ) {
			$update['updates'] = $u;
		}

		if ( ! empty( $nums['scan'] ) ) {
			$update['last_scan'] = $nums['scan']['finished'];

			if ( $nb = crb_array_get( $nums['scan'], 'numbers' ) ) {
				// TODO move to separate meta table
				cerber_update_set( '_nexus_tmp_' . $slave->id, $nb );
			}
		}

	}

	if ( $update ) {
		$result = nexus_update_slave( $slave->id, $update );
	}

}

/**
 * @param $payload array
 * @param $slave object
 *
 * @return bool|array|string|WP_Error
 */
function nexus_net_send_request( $payload, $slave ) {
	global $crb_assets_url, $nexus_last_http, $nexus_last_curl;

	if ( ! is_super_admin()
	     && ! ( defined( 'CRB_DOING_BG_TASK' ) && CRB_DOING_BG_TASK ) ) {
		return new WP_Error( 'no_context', 'Not permitted in this context' );
	}

	if ( empty( $slave->site_pass )
	     || empty( $slave->site_url )
	     || empty( $slave->x_field )
	     || empty( $slave->x_num )
	     || ( ! $field_names = nexus_get_fields( $slave ) ) ) {
		return new WP_Error( 'invalid_slave', 'Slave configuration is corrupted for the slave ' . $slave->id );
	}

	array_walk_recursive( $payload, function ( &$e ) {
		$e = str_replace( array( "\r\n", "\n", "\r" ), '<br/>', $e ); // preserve new lines before json_encode
	} );

	$data            = array();
	$data['seal']    = nexus_seal();
	$data['params']  = $_GET;
	$data['base']    = ( ! is_multisite() ) ? admin_url() : network_admin_url();
	$data['assets']  = $crb_assets_url;
	$data['is_post'] = cerber_is_http_post();
	$data['payload'] = $payload;
	$data[ rand() ]  = rand(); // random checksum for identical requests

	if ( ! ( defined( 'DOING_AJAX' ) && DOING_AJAX )
	     && ! cerber_is_wp_cron() ) {
		$data['page']    = crb_admin_get_page();
		$data['tab']     = crb_admin_get_tab();
		$data['at_site'] = ( ! crb_get_settings( 'master_at_site' ) ) ? '' : ' @ ' . $slave->site_name;
		$data['screen']  = array( 'per_page' => crb_admin_get_per_page() );
	}

	$x_num = array_shift( $field_names );

	$fields = array();

	$fields[ $field_names[0] ] = json_encode( $data, JSON_UNESCAPED_UNICODE );
	if ( JSON_ERROR_NONE != json_last_error() ) {
		return new WP_Error( 'json_error', 'Unable to encode request: ' . json_last_error_msg() );
	}

	$auth = hash( 'sha512', $slave->site_pass . sha1( $fields[ $field_names[0] ] ) );

	foreach ( $field_names as $i => $name ) {
		if ( isset( $fields[ $name ] ) ) {
			continue;
		}
		if ( $x_num == $i ) {
			$fields[ $name ] = $auth;
		}
		else {
			$fields[ $name ] = str_shuffle( $auth );
		}
	}

	$curl = @curl_init();
	if ( ! $curl ) {
		return new WP_Error( 'no_curl', 'Unable to init cURL library. Enable PHP cURL extension in your hosting control panel.' );
	}

	nexus_diag_log( 'Sending HTTP request to ' . $slave->site_url );

	curl_setopt_array( $curl, array(
		CURLOPT_URL               => $slave->site_url,
		CURLOPT_FOLLOWLOCATION    => 0,
		CURLOPT_POST              => true,
		CURLOPT_POSTFIELDS        => http_build_query( $fields ),
		CURLOPT_RETURNTRANSFER    => true,
		CURLOPT_CONNECTTIMEOUT    => 10, // including domain resolving
		CURLOPT_TIMEOUT           => 15, // including CURLOPT_CONNECTTIMEOUT
		CURLOPT_DNS_CACHE_TIMEOUT => 1 * 3600,
		CURLOPT_SSL_VERIFYHOST    => 2,
		CURLOPT_SSL_VERIFYPEER    => true,
		//CURLOPT_CERTINFO          => 1, doesn't work
		//CURLOPT_VERBOSE          => 1,
		CURLOPT_CAINFO            => ABSPATH . WPINC . '/certificates/ca-bundle.crt',
		CURLOPT_ENCODING          => '' // allows built-in compressions
	) );

	$response = @curl_exec( $curl );
	$curl_info = curl_getinfo( $curl );
	$code = intval( curl_getinfo( $curl, CURLINFO_HTTP_CODE ) );
	$nexus_last_http = $code;
	$nexus_last_curl = $curl_info;

	curl_close( $curl );

	if ( $code == 200 ) {
		nexus_diag_log( 'HTTP 200 OK' );
		nexus_diag_log( 'Slave data size ' . $curl_info['size_download'] . ', receiving took ' . $curl_info['total_time'] . ' seconds' );
	}

	nexus_diag_log( 'Domain name lookup took ' . $curl_info['namelookup_time'] . ' seconds' );

	if ( $code != 200 ) {
		nexus_diag_log( '=== NETWORK SUBSYSTEM ===' );
		nexus_diag_log( $curl_info );
		/*if ( $code != 403 ) {
			cerber_update_set( 'bad_response_' . $slave->id, array( time(), $code ) );
		}*/
		return new WP_Error( 'http_error', $code );
	}

	$ret = json_decode( $response, true );
	if ( JSON_ERROR_NONE != json_last_error() ) {
		return new WP_Error( 'json_error', 'Unable to decode the response: ' . json_last_error_msg() );
	}

	if ( is_array( $ret['payload'] ) ) {
		$sha = sha1( serialize( $ret['payload'] ) );
	}
	else {
		$sha = sha1( $ret['payload'] );
	}

	if ( ! hash_equals( $ret['echo'], hash( 'sha512', $slave->site_echo . $sha ) ) ) {
		return new WP_Error( 'checksum_error', 'Checksum mismatch: the slave response has been altered or security tokens mismatch.' );
	}

	nexus_diag_log( 'Slave ' . $slave->site_name . ' generated response ' . $ret['p_time'] );

	nexus_diag_log( '=== NETWORK HAS FINISHED OK ===' );

    return $ret;
}

function nexus_set_context( $slave_id = null ) {
	if ( 'nexus_switch' != cerber_get_get( 'cerber_admin_do' )
	     || ! wp_verify_nonce( cerber_get_get( 'cerber_nonce' ), 'control' )
	     || ! is_super_admin() ) {
		return;
	}

	if ( $slave_id === null ) {
		$id = cerber_get_get( 'nexus_site_id' );
	}

	if ( $slave = nexus_get_slave_data( $id ) ) {
		if ( crb_get_settings( 'master_swshow' ) ) {
			cerber_admin_message( sprintf( __( 'You have switched to %s', 'wp-cerber' ), $slave->site_name ) . '. ' . 'To switch back to the master, click the X icon on the toolbar.' );
		}
		$expire = time() + apply_filters( 'auth_cookie_expiration', 14 * DAY_IN_SECONDS, get_current_user_id(), true );
	}
	else {
		cerber_admin_message( __( 'You have switched back to the master website', 'wp-cerber' ) );
		$expire = time();
		$id = 0;
	}

	setcookie( 'cerber_nexus_id', $id, $expire, '/' );

	if ( $id ) {
		if ( crb_admin_get_page() == 'cerber-nexus' ) {
			$url = cerber_admin_link();
		}
		else {
			$url = remove_query_arg( array(
				'cerber_admin_do',
				'cerber_nonce',
				'nexus_site_id'
			) );
		}
	}
	else {
		if ( crb_get_settings( 'master_tolist' ) ) {
			$url = cerber_admin_link( 'nexus_sites' );
		}
		else {
			$url = remove_query_arg( array(
				'cerber_admin_do',
				'cerber_nonce',
				'nexus_site_id'
			) );
		}
	}

	if ( ! $url ) {
		$url = cerber_admin_link();
	}

	wp_safe_redirect( $url );

	exit();
}

/**
 * A light version of nonce (pre-nonce)
 *
 * @param null $check_it
 *
 * @return bool|string
 */
function nexus_seal( $check_it = null ) {
	$slave = nexus_get_context();
	if ( ! $slave || ! $uid = get_current_user_id() ) {
		return false;
	}
	$seal = sha1( $slave->id . '|' . $uid . '|' . PHP_VERSION . '|' . PHP_SAPI );
	if ( $check_it === null ) {
		return $seal;
	}

	return ( $seal === $check_it );
}

function nexus_do_bulk() {
	if ( ! $ids = cerber_get_get( 'ids' ) ) {
		cerber_admin_notice( 'No items selected' );
		return;
	}
	switch ( cerber_get_bulk_action() ) {
		case 'nexus_delete_slave':
			nexus_delete_slave( $ids );
			break;
		case 'nexus_upgrade_plugins':
			nexus_bg_upgrade( $ids, array() );
			//nexus_do_upgrade( $ids[0], array( CERBER_PLUGIN_ID ) );
			break;
		case 'nexus_upgrade_cerber':
			nexus_bg_upgrade( $ids, array( CERBER_PLUGIN_ID ) );
			//nexus_do_upgrade( $ids[0], array( CERBER_PLUGIN_ID ) );
			break;
	}
}

function nexus_bg_upgrade( $ids, $plugins ) {
	foreach ( $ids as $id ) {
		cerber_bg_task_add( array(
			'func'  => 'nexus_do_upgrade',
			'args'  => array( $id, $plugins, false ),
			'exec_until' => 'stop', // may not be boolean
		) );
	}
	cerber_admin_message( 'A background upgrade task has been launched' );
}

function nexus_do_upgrade( $slave, $plugins, $display_errors = false ) {
	$response = nexus_send( array(
		'type'    => 'sw_upgrade',
		'sw_type' => 'plugins',
		'list'    => $plugins
	), $slave );

	if ( ! empty( $response['results'] ) ) {
		nexus_diag_log( cerber_flat_results( $response['results'], $display_errors ) );
	}

	if ( ! empty( $response['wait'] ) ) {
		nexus_diag_log( 'Waiting for request from ' . $response['wait'] . ' is completed' );
		sleep( 10 );
	}

	if ( empty( $response ) || ! empty( $response['completed'] ) ) {
		return 'stop';
	}

	sleep( 3 );

	return 0;
}

function nexus_schedule_refresh() {
    // ORDER BY id DESC ?
	if ( $sites = cerber_db_get_col( 'SELECT id FROM ' . cerber_get_db_prefix() . CERBER_MS_TABLE . ' WHERE refreshed < ' . ( time() - 3600 ) . ' AND last_http <= 200 LIMIT 50' ) ) {
		foreach ( $sites as $id ) {

			// Protective interval
			// TODO move to separate meta table
			$key = 'nexus_scheduled_' . $id;
			if ( cerber_get_set( $key, 0, false ) ) {
				continue;
			}
			cerber_update_set( $key, 1, 0, false, time() + 60 );

			cerber_bg_task_add( array( 'func' => 'nexus_send', 'args' => array( array( 'type' => 'hello' ), $id ) ) );
		}
	}
}

add_action( 'wp_before_admin_bar_render', function () {
	global $wp_admin_bar;

	if ( ! cerber_is_admin_page()
	     || ! nexus_is_master() ) {
		return;
	}

	if ( ! is_admin_bar_showing()
	     || ! $wp_admin_bar instanceof WP_Admin_Bar ) {
		return;
	}

	?>
    <div id="crb-popup-add-slave" style="display:none;">
        <form id="crb-add-slave" method="post" action="<?php echo cerber_admin_link( 'nexus_sites' ); ?>"
              style="padding-top:15px; height: 100%;">
			<?php wp_nonce_field( 'control', 'cerber_nonce' ); ?>
            <input type="hidden" name="page" value="cerber-nexus">
            <textarea name="new_slave_token" style="width: 100%; height: 80%; font-family: monospace;"
                      placeholder="Copy and paste Secret Access Token here"></textarea>
	        <?php
            //echo cerber_select( 'new_slave_group', nexus_get_groups(), 0, 'crb-wide', 'crb-select2-tags' )
            ?>
            <input type="hidden" name="cerber_admin_do" value="add_slave">
            <p style="text-align: center;"><input type="submit" class="button button-primary" value="Add Website"></p>
        </form>
    </div>
	<?php

	//$wp_admin_bar->remove_node( 'new-content' );
	//$wp_admin_bar->remove_node( 'my-account' );
	$exclude = array();
	$exclude = array( 'query-monitor' );
	//$exclude = array( 'top-secondary' );
	foreach ( $wp_admin_bar->get_nodes() as $node => $data ) {
		if ( in_array( $data->id, $exclude ) ) {
			continue;
		}
		if ( empty( $data->parent ) ) {
			$wp_admin_bar->remove_node( $data->id );
		}
	}

	$current_id = null;
	if ( $current = nexus_get_context() ) {
		$current_id = $current->id;
		$title = __( 'You are here:', 'wp-cerber' ) . ' ' . $current->site_name;
	}
	else {
		$title = __( 'My Websites', 'wp-cerber' );
    }

	$wp_admin_bar->add_node( array(
		'id'    => 'crb_site_switch',
		'title' => '<span class="ab-icon"></span>' . $title,
		'href'  => cerber_admin_link( 'nexus_sites' ),
		'meta'  => array( 'class' => 'cerber-site-select' )
	) );

	$this_page = cerber_admin_link( crb_admin_get_tab(), array( 'page' => crb_admin_get_page() ), true );

	if ( $current ) {
		$wp_admin_bar->add_node( array(
			'id'    => 'crb_slave_site_menu',
			'title' => '<span class="ab-icon"></span>' . __( 'Visit Site' ),
			'href'  => $current->site_url,
		) );
		$wp_admin_bar->add_node( array(
			'id'     => 'crb_slave_admin',
			'parent' => 'crb_slave_site_menu',
			'title'  => 'Dashboard',
			'href'   => trim( $current->site_url, '/' ) . '/wp-admin/',
		) );


		$wp_admin_bar->add_node( array(
			'id'    => 'crb_to_master',
			//'parent' => 'top-secondary',
			'title' => '<span class="ab-icon"></span>',
			'meta'  => array( 'class' => 'ab-top-secondary', 'title' => 'Switch to the master' ),
			'href'  => nexus_get_back_link(),
		) );
	}

	if ( $slaves = nexus_get_slaves( array( 'orderby' => 'id', 'order' => 'DESC' ) ) ) {
		foreach ( $slaves as $slave ) {
			if ( $current_id === $slave->id ) {
				continue;
			}
			$wp_admin_bar->add_node( array(
				'parent' => 'crb_site_switch',
				'id'     => 'site' . $slave->id,
				'title'  => $slave->site_name,
				'href'   => $this_page . '&cerber_admin_do=nexus_switch&nexus_site_id=' . $slave->id,
			) );
		}
	}
	else {
		$wp_admin_bar->add_node( array(
			'parent' => 'crb_site_switch',
			'id'     => 'none',
			'title'  => 'Click here to add a slave website',
			'href'   => cerber_admin_link( 'nexus_sites' ),
		) );
	}

}, 9999 );

add_filter( 'admin_body_class', function ( $var ) {
	if ( cerber_is_admin_page() && nexus_get_context() ) {
		$var .= ' crb-remote';
	}

	return $var;
} );

add_action( 'admin_head', function () {
	if ( ! cerber_is_admin_page() || ! nexus_is_master() ) {
		return;
	}
	?>
    <style type="text/css" media="all">
        /* WP menu if on remote */
        .crb-remote .wp-not-current-submenu .wp-menu-name,
        .crb-remote .wp-not-current-submenu .wp-menu-image::before {
            color: #555 !important;
        }
        .crb-remote .wp-not-current-submenu .update-plugins,
        .crb-remote .wp-not-current-submenu .awaiting-mod {
            display: none !important;
        }

        /* Admin bar if on remote */
        .crb-remote #wpadminbar,
        .crb-remote #wpadminbar  div.ab-sub-wrapper,
        .crb-remote #wpadminbar  div.ab-sub-wrapper li,
        .crb-remote #wpadminbar .ab-item {
            /*background-color: #2d5c8b !important;*/
            background-color: #005696 !important;
            color: #fff !important;
        }

        #wp-admin-bar-crb_site_switch .ab-sub-wrapper .ab-item:hover {
            color: #fff !important;
            background-color: #777 !important;
        }
        .crb-remote #wp-admin-bar-crb_site_switch .ab-sub-wrapper .ab-item:hover {
            color: #fff !important;
            background-color: #333 !important;
        }

        ul li#wp-admin-bar-crb_site_switch > a {
            letter-spacing: 0.06em !important;
        }

        ul li#wp-admin-bar-crb_site_switch {
            padding-right: 1em;
        }

        #wp-admin-bar-crb_site_switch .ab-icon::before {
            content: "\f333";
        }

        #wp-admin-bar-crb_site_switch div.ab-sub-wrapper {
            max-height: 500px;
            max-width: 500px;
            min-width: 220px !important;
            /*padding-right: 2em !important;*/
            overflow: auto;
            /*overflow-x: visible;*/
        }

        #wpadminbar .ab-icon {
            top: 2px !important;
        }

        .crb-remote #wpadminbar .ab-icon::before {
            color: #fff;
        }

        #wp-admin-bar-crb_slave_site_menu .ab-icon::before {
            content: "\f102";
        }

        #wp-admin-bar-crb_to_master .ab-icon::before {
            content: "\f158";
        }

        @media screen and (min-width: 1000px) {
            #crb-form-slave-edit-form table {
                max-width: 800px;
                /*padding-right: 30%;*/
            }
        }

        /* Site List */

        #crb-nexus-sites select option:last-child{
            color: #777;
        }

        @media screen and (min-width: 768px) {
            .crb-main .fixed .column-site_name {
                width: 20%;
            }
        }

        .crb-main .column-site_url {
            width: 18%;
        }

        .crb-main .column-site_url,
        .crb-main .column-site_url a{
            /*overflow-wrap: normal;*/
            /*word-break: keep-all !important; */
            word-wrap: normal !important;
        }

    </style>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            $("#wp-admin-bar-crb_slave_site_menu a").attr('target','_blank');

            $("#crb-nexus-sites .bulkactions .button").click(function (e) {
                if ('nexus_delete_slave' === $(this).prev('select').find(':selected').val()) {
                    if (!confirm('<?php _e( 'Are you sure you want to delete selected websites?', 'wp-cerber' ) ?>')) {
                        e.preventDefault();
                    }
                }
            });
        });
    </script>

	<?php
});


