<?php

global $tallbike_db_version;
$tallbike_db_version = '0.1';

function tallbike_install() { 
    // Trigger our function that registers the custom post type plugin.
    tbBikes_setup_post_type(); 
    flush_rewrite_rules(); 
    tbEvents_setup_post_type(); 
    // Clear the permalinks after the post type has been registered.
    flush_rewrite_rules(); 
}

function tbBikes_setup_post_type() {
    $Bikes_Labels = array(
        'name'          => 'Bikes',
        'singular_name' => 'Bike',
        'search_items'  => 'Bike suchen',
        'all_items'     => 'Alle Bikes',
        'parent_item'   => 'Parent?',
        'parent_item_colon' => 'Parent?:',
        'edit_item'     => 'Bikes bearbeiten',
        'update_item'   => 'Bike aktualisieren',
        'add_new_item'  => 'Neues Bike hinzufügen',
        'new_item_name' => 'Neues Rad',
        'menu_name'     => 'Bikes',
    );

    $Bikes_Options = array(
        'labels'      => $Bikes_Labels,
        'public'      => true,
        'has_archive' => true,
        'menu_position' => 5,
        'supports' => ['title', 'editor' , 'author', 'custom-fields',],
        'rewrite'     => array( 'slug' => 'bikes' ), 
        'delete_with_user' => false,
        //these are the two important lines for the entries in the Block Editor!
        'show_in_rest' => true,
        'supports' => array('editor'),
    );
    register_post_type( 'Bikes', $Bikes_Options); 
    // Bikes will be accessible with this URL: http://localhost:8888/?post_type=bikes
}

function tbEvents_setup_post_type() {
    $Events_Labels = array(
        'name'          => 'Events',
        'singular_name' => 'Event',
        'search_items'  => 'Events suchen',
        'all_items'     => 'Alle Events',
        'parent_item'   => 'Parent?',
        'parent_item_colon' => 'Parent?:',
        'edit_item'     => 'Events bearbeiten',
        'update_item'   => 'Event aktualisieren',
        'add_new_item'  => 'Neuen Event hinzufügen',
        'new_item_name' => 'Neuer Event',
        'menu_name'     => 'Events',
    );

    $Events_Options = array(
        'labels'      => $Events_Labels,
        'public'      => true,
        'has_archive' => true,
        'menu_position' => 5,
        'supports' => ['title', 'editor' ,'author', 'comments', 'custom-fields',],
        'rewrite'     => array( 'slug' => 'events' ), 
        'delete_with_user' => false,
        'show_in_rest' => true,
        'supports' => array('editor'),
    );

    register_post_type( 'Events', $Events_Options); 
} 


function tallbike_Hardcoding_SQL () {

    global $wpdb;
 
    $tablebikes_name = $wpdb->prefix . "Bikes"; 
    $tableevents_name = $wpdb->prefix . "Events"; 
    $tablebadges_name = $wpdb->prefix . "Badges"; 
    $tablelinkBUE_name = $wpdb->prefix . "Link_Bike_User_Event"; 
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $sql_bikes = "CREATE TABLE $tablebikes_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    $sql_events = "CREATE TABLE $tableevents_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    
    $sql_badges = "CREATE TABLE $tablebadges_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        picture varchar(128),
        PRIMARY KEY  (id)
    ) $charset_collate;";

    $sql_link_bike_user_event = "CREATE TABLE $tablelinkBUE_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        bikeid mediumint(9) NOT NULL,
        userid mediumint(9) NOT NULL,
        eventid mediumint(9) NOT NULL,
        points real,
        text text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";


    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql_bikes );
    dbDelta( $sql_events );
    dbDelta( $sql_badges );
    dbDelta( $sql_link_bike_user_event );

 }
 
 // ******************************
 // Entering some example data
// ******************************

 function tallbike_install_data() {

    global $wpdb;
	
	$table_name = $wpdb->prefix . 'Bikes';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'name' => "Goldie",
		) 
	);

    $wpdb->insert( 
		$table_name, 
		array( 
			'name' => "Talldem",
		) 
	);

    $wpdb->insert( 
		$table_name, 
		array( 
			'name' => "Edel-Traut",
		) 
	);

    $wpdb->insert( 
		$table_name, 
		array( 
			'name' => "Sally",
		) 
	);

    $table_name = $wpdb->prefix . 'Events';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'name' => "Tour",
            'time' => current_time( 'mysql' ),
            'text' => "eine Tour",
		) 
	);
	$wpdb->insert( 
		$table_name, 
		array( 
			'name' => "Nikolaus-Ride",
            'time' => "2021-12-06",
            'text' => "Mit drei beleuchteten Tallbikes, Bademantel und Kasperlemütze in der Stadt unterwegs gewesen!",
		) 
	);

    $table_name = $wpdb->prefix . 'Badges';

    $wpdb->insert( 
		$table_name, 
		array( 
			'name' => "Chorleiter 1",
            'time' => "2021-12-05 16:00",
            'text' => "So laut gesungen, dass alle mitgemacht haben!",
            'picture' => "",
		) 
	);

    $table_name = $wpdb->prefix . 'Link_Bike_User_Event';

    $wpdb->insert( 
		$table_name, 
		array( 
			'userid' => 1,
            'bikeid' => 1,
            'eventid' => 1,
            'text' => "irgendwas",
            'points' => 100
		) 
	);

}

 ?>