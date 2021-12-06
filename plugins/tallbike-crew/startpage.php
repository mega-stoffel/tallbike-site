<?php
/*
Plugin Name:  Tallbike-Crew
Plugin URI:   https://github.com/mega-stoffel/tallbike-site
Description:  Adding Bikes and Events to Wordpress and connecting them with the existing Users.
Version:      0.1
Author:       X-tof Hoyer
Author URI:   https://tallbike-stuttgart.de
*/

if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}

$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
check_admin_referer( "activate-plugin_{$plugin}" );

register_activation_hook( __FILE__ , 'tallbike_install' );
register_activation_hook( __FILE__ , 'tallbike_install_data' );

//todo: this doesn't seem to work!
register_deactivation_hook( __FILE__ , 'tallbike_delete' );


function add_Bikes_menu() {
	add_menu_page("Bikes", "Bikes", "edit_posts", "bikes", "showBikes", "dashicons-car", 3);
    //add_menu_page("Custom Plugin", "Custom Plugin","manage_options", "myplugin", "displayList",plugins_url('/tallbike-crew/pictures/bikes.svg'));
}

function add_Events_menu() {
    add_menu_page("Events", "Events","edit_posts", "events", "showEvents", "dashicons-megaphone", 3);
}

add_action ( "admin_menu", "add_Bikes_menu" );
add_action ( "admin_menu", "add_Events_menu" );

function showBikes(){
    include "bikesshow.php";
  }

function showEvents(){
    include "eventsshow.php";
  }

/* here's all installation related stuff, creating new tables, etc */
include "install/tallbike-installation.php"
?>