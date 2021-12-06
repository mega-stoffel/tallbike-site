<?php

global $tallbike_db_version;
$tallbike_db_version = '0.1';

function tallbike_install () {

    global $wpdb;
 
    $tablebikes_name = $wpdb->prefix . "Bikes"; 
    $tableevents_name = $wpdb->prefix . "Events"; 
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $sql1 = "CREATE TABLE $tablebikes_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    name tinytext NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";

    $sql2 = "CREATE TABLE $tableevents_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        PRIMARY KEY  (id)
        ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql1 );
    dbDelta( $sql2 );
 }
 
 

 function tallbike_install_data() {

    global $wpdb;
	
	$welcome_name = 'Mr. WordPres';
	$welcome_text = 'Congratulations, you just completed the installation!';
	
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

    $table_name = $wpdb->prefix . 'Events';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'name' => "Tour",
            'time' => current_time( 'mysql' ),
            'text' => "eine Tour",
		) 
	);
}

 ?>