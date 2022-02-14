<?php
/*
Plugin Name:  Tallbike-Crew
Plugin URI:   https://github.com/mega-stoffel/tallbike-site
Description:  Adding Bikes and Events to Wordpress and connecting them with the existing Users.
Version:      0.2
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

//require_once( 'post_types/bikes.php' );
//require_once( 'post_types/events.php' );


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

// -----------------------------------------------------
// Some working AJAX !
// -----------------------------------------------------
add_action("wp_ajax_tb_addme_tour", "tb_addme_tour");
//add_action("wp_ajax_nopriv_my_user_vote", "my_must_login");

function tb_addme_tour() {

   global $wpdb;

   if ( !wp_verify_nonce( $_REQUEST['nonce'], "tb_addme_tour_nonce")) {
      exit("So wird das nix!");
   }   
   $current_eventID = $_REQUEST["post_id"];
   $current_userID = $_REQUEST["tbuser"];

   //$addme = update_post_meta($_REQUEST["post_id"], "events_cf_Length", $new_vote_count);

   $rows_affected = $wpdb->insert
   (
      'wp_Link_Bike_User_Event',
      array(
          'userid' => $current_userID,
          'eventid' => $current_eventID,
          'text' => '',
          'points' => 1,
      ),
      array('%d','%d','%s','%f') 
  );

   if($vote === false) {
      $result['type'] = "error";
      $result['vote_count'] = $vote_count;
   }
   else {
      $result['type'] = "success";
      $result['vote_count'] = $new_vote_count;
   }

   if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $result = json_encode($result);
      echo $result;
   }
   else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
   }

   die();

}

function my_must_login() {
   echo "You must log in to vote";
   die();
}

// -----------------------------------
//       S H O R T C O D E S
// -----------------------------------
require_once( 'libs/tb-shortcodes.php' );
add_shortcode('tb_kommendeTouren', 'tb_future_events');
add_shortcode('tb_vergangeneTouren', 'tb_previous_events');


// ---------------------------------
//       W I D G E T S 
// ---------------------------------
// require_once( 'libs/tb-widgets.php' );
// Register my widget for all future Events
// function tb_future_events_widget() {
// 	register_widget( 'Future_Events' );
// }
// add_action( 'widgets_init', 'tb_future_events_widget' );




// --------------------------------------------------------
// Trying a different AJAX approach
// --------------------------------------------------------
// enqueue and localise scripts
//wp_enqueue_script( 'my-ajax-handle', plugin_dir_url( __FILE__ ) . 'ajax.js', array( 'jquery' ) );
//wp_localize_script( 'my-ajax-handle', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
// THE AJAX ADD ACTIONS
// add_action( 'wp_ajax_the_ajax_hook', 'the_action_function' );
// add_action( 'wp_ajax_nopriv_the_ajax_hook', 'the_action_function' ); // need this to serve non logged in users

// THE FUNCTION
// function the_action_function(){
//     /* this area is very simple but being serverside it affords the possibility of retreiving data from the server and passing it back to the javascript function */
//     $name = $_POST['name'];
//     echo"Hello World, " . $name;// this is passed back to the javascript function
//     die();// wordpress may print out a spurious zero without this - can be particularly bad if using json
// }

// ADD EG A FORM TO THE PAGE
// function hello_world_ajax_frontend(){
//     $the_form = '
//     <form id="theForm">
//     <input id="name" name="name" value = "name" type="text" />
//     <input name="action" type="hidden" value="the_ajax_hook" />&nbsp; <!-- this puts the action the_ajax_hook into the serialized form -->
//     <input id="submit_button" value = "Click This" type="button" onClick="submit_me();" />
//     </form>
//     <div id="response_area">
//     This is where we\'ll get the response
//     </div>';
//     return $the_form;
// }
//add_shortcode("hw_ajax_frontend", "hello_world_ajax_frontend");

// --------------------------------------------------------


// --------------------------------------------------------
// This is (probably) needed for the AJAX stuff:
// /public function tbrun() {     
   // Enqueue plugin styles and scripts
//   add_action( ‘plugins_loaded’, array( $this, 'enqueue_tallbikes_scripts' ) );
//   add_action( ‘plugins_loaded’, array( $this, 'enqueue_tallbikes_styles' ) );      
// }   
/**
* Register plugin styles and scripts
*/
// public function register_rml_scripts() {
//   wp_register_script( 'tallbikes-script', plugins_url( 'js/tallbikes.js', __FILE__ ), array('jquery'), null, true );
//   wp_register_style( 'tallbikes-style', plugins_url( 'css/tallbikes.css' ) );
// }   
/**
* Enqueues plugin-specific scripts.
*/
// public function enqueue_tallbikes_scripts() {        
//   wp_enqueue_script( 'tallbikes-script' );
// }   
/**
* Enqueues plugin-specific styles.
*/
// public function enqueue_tallbikes_styles() {         
//   wp_enqueue_style( 'tallbikes-style' ); 
// }
// --------------------------------------------------------

?>