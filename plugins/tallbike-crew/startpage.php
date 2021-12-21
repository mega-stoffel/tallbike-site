<?php
/*
Plugin Name:  Tallbike-Crew
Plugin URI:   https://github.com/mega-stoffel/tallbike-site
Description:  Adding Bikes and Events to Wordpress and connecting them with the existing Users.
Version:      0.1
Author:       X-tof Hoyer
Author URI:   https://tallbike-stuttgart.de
*/

/*if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}

$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
check_admin_referer( "activate-plugin_{$plugin}" );*/

//These two lines define my own theme output:
define('TALLBIKE_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
require_once TALLBIKE_PLUGIN_PATH.'/libs/register_custom_theme_files.php';

register_activation_hook( __FILE__ , 'tallbike_install' );
//register_activation_hook( __FILE__ , 'tallbike_install_data' );

add_action( 'init', 'tbBikes_setup_post_type' );
add_action( 'init', 'tbEvents_setup_post_type' );
add_action( 'init', 'tallbike_shortcodes_init' );

//todo: this doesn't seem to work!
register_deactivation_hook( __FILE__ , 'tallbike_delete' );

require_once( 'post_types/bikes.php' );

// This function adds bikes and events to the regular posts query!
// I guess, I need to write my own widgets/pages for my custom post types....
function wporg_add_custom_post_types($query) {
  if ( is_home() && $query->is_main_query() ) {
      $query->set( 'post_type', array( 'post', 'bikes', 'events' ) );
  }
  return $query;
}
add_action('pre_get_posts', 'wporg_add_custom_post_types');

/*function add_Bikes_menu() {
	add_menu_page("Bikes", "Bikes", "edit_posts", "bikes", "showBikes", "dashicons-car", 3);
    //add_menu_page("Custom Plugin", "Custom Plugin","manage_options", "myplugin", "displayList",plugins_url('/tallbike-crew/pictures/bikes.svg'));
}

function add_Events_menu() {
    add_menu_page("Events", "Events","edit_posts", "events", "showEvents", "dashicons-megaphone", 3);
}

function add_Badges_menu() {
  add_menu_page("Orden", "Orden","edit_posts", "badges", "showBadges", "dashicons-insert-after", 4);
}

function add_Links_menu() {
  add_menu_page("BUE", "BUE","edit_posts", "together", "showLinks", "dashicons-admin-links", 4);
}

add_action ( "admin_menu", "add_Bikes_menu" );
add_action ( "admin_menu", "add_Events_menu" );
add_action ( "admin_menu", "add_Badges_menu" );
add_action ( "admin_menu", "add_Links_menu" );

function showBikes(){
    include "bikesshow.php";
  }

function showEvents(){
    include "eventsshow.php";
  }

function showBadges(){
    include "badgesshow.php";
  }

  function showLinks(){
    include "linksBUEshow.php";
  }
  */

/* here's all installation related stuff, creating new tables, etc */
include "install/tallbike-installation.php";
include "libs/add_shortcodes.php";

?>