<?php

if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}
check_admin_referer( 'bulk-plugins' );

if ( __FILE__ != WP_UNINSTALL_PLUGIN ) {
	return;
}

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Uninstallation actions here
function tallbike_delete () {

    global $wpdb;

    $tablebikes_name = $wpdb->prefix . "Bikes"; 
    $tableevents_name = $wpdb->prefix . "Events"; 
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $sql1 = "DROP TABLE $tablebikes_name;";
    $sql2 = "DROP TABLE $tableevents_name;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql1 );
    dbDelta( $sql2 );
}

?>