<?php

// I got this basic information from this page:
// https://www.inkthemes.com/learn-how-to-create-shortcodes-in-wordpress-plugin-with-examples/
// remember the include in the startpage.php

function tb_future_events(){

// the next event is shown until 01:00 of the next day, probably some UTC stuff.
// Could maybe get fixed, one day....

    wp_reset_postdata();

    // get today's date:
    $tbtoday = date('Y-m-d');

    // Query Definition, especially for meta values and their comparision
    // https://developer.wordpress.org/reference/classes/wp_query/
    $queryArgs = array( 
        'post_type'	=> 'events',
        'posts_per_page' => 3,
        //'orderby'   => 'events_cf_date',
        'order'     => 'DESC',
        'meta_key'  => 'events_cf_Date',
        'orderby'   => 'events_cf_Date',
        'meta_value'    => $tbtoday,
        'meta_compare'  => '>=',
    );

    //'meta_key'  => 'events_cf_Date',
    //'after'     => 'January 1st, 2022',

    $tb_futureevents = "<br><h3>Kommende Touren</h3><br>";

    $tb_events_query = new WP_Query( $queryArgs ); 

    if ( $tb_events_query->have_posts() ) {
        $tb_futureevents .= "<ul>";
        while ( $tb_events_query->have_posts() ) {
            $tb_events_query->the_post();
            $current_eventID = get_the_ID();
            $current_eventtimestamp = esc_attr( get_post_meta($current_eventID, 'events_cf_Date', true ) );
            $eventDateFormatted = strtotime($current_eventtimestamp);
            $current_eventDate = date("d.m.Y",$eventDateFormatted);
            $current_eventTime = date("H:i",$eventDateFormatted);
            
            $date = new DateTime($current_eventtimestamp);
            $date->format('d.M.YY');
            //$current_eventDate = date('d.M.Y', $current_eventtimestamp);
            $tb_futureevents .=  '<li><h4>'. get_the_title() . '</h4>';
            $tb_futureevents .=  "Wann? " . $current_eventDate . " um " . $current_eventTime ." Uhr<br>";
            $tb_futureevents .=  "Wo? " . esc_attr( get_post_meta($current_eventID, 'events_cf_Place', true ) ) . "</li>";
        }
        $tb_futureevents .=  '</ul>';
    } else {
        $tb_futureevents = "<p>Aktuell stehen keine Touren an!</p>";
    }
    /* Restore original Post Data */
    wp_reset_postdata();

    //$output = "<p>Hello, This is your another shortcode!</p>"; 
    return $tb_futureevents;    
    }

function tb_previous_events(){

wp_reset_postdata();

// get today's date:
$tbtoday = date('Y-m-d\TH:i');

$queryArgs = array( 
    'post_type'	=> 'events',
    'posts_per_page' => 6,
    //'orderby'   => 'events_cf_date',
    'order'     => 'DESC',
    'meta_key'  => 'events_cf_Date',
    'orderby'   => 'events_cf_Date',
    'meta_value'    => $tbtoday,
    'meta_compare'  => '<=',
);

$tb_previousevents = "<br><h3>Vergangene Touren</h3><br>";

$tb_events_query = new WP_Query( $queryArgs ); 

if ( $tb_events_query->have_posts() ) {
    $tb_previousevents .= "<ul>";
    
    while ( $tb_events_query->have_posts() ) {
        $tb_events_query->the_post();
        $current_eventID = get_the_ID();
        $current_eventtimestamp = esc_attr( get_post_meta($current_eventID, 'events_cf_Date', true ) );
        $eventDateFormatted = strtotime($current_eventtimestamp);
        $current_eventDate = date("d.m.Y",$eventDateFormatted);
        $current_eventTime = date("H:i",$eventDateFormatted);
        
        $date = new DateTime($current_eventtimestamp);
        $date->format('d.M.YY');
        //$current_eventDate = date('d.M.Y', $current_eventtimestamp);
        $tb_previousevents .= "<li>";
        $tb_previousevents .=  '<h4><a href="'. get_the_permalink() .'">' . get_the_title() . '</a></h4>';
        $tb_previousevents .=  "Wann? " . $current_eventDate . " um " . $current_eventTime ." Uhr<br>";
        $tb_previousevents .=  "Wo? " . esc_attr( get_post_meta($current_eventID, 'events_cf_Place', true ) );
        //$tb_previousevents .=  $current_eventtimestamp . " -- " . $tbtoday .' </li>';
        $tb_previousevents .=  '<br><br></li>';
    }
    $tb_previousevents .=  '</ul>';
    //$tb_previousevents .=  '</p><br>';
} else {
    $tb_previousevents = "<p>Aktuell stehen keine Touren an!</p>";
}
/* Restore original Post Data */
wp_reset_postdata();

//$output = "<p>Hello, This is your another shortcode!</p>"; 
return $tb_previousevents;    
}


function tb_all_users(){
    
    wp_reset_postdata();
    
    // get today's date:
    $tbtoday = date('Y-m-d');
    
    $userqueryargs = array(
        'orderby' => 'display_name',
    );
        // check for two meta_values
        // 'meta_query' => array(
        //     array(
        //         // uses compare like WP_Query
        //         'key' => 'some_user_meta_key',
        //         'value' => 'some user meta value',
        //         'compare' => '>'
        //         ),
        //     array(
        //         // by default compare is '='
        //         'key' => 'some_other_user_meta_key',
        //         'value' => 'some other meta value',
        //         ),
        //     // add more
        // ));

//  $wp_user_search = $wpdb->get_results("SELECT ID, display_name FROM $wpdb->users ORDER BY ID");

//  foreach ( $wp_user_search as $userid ) {
// 	$user_id       = (int) $userid->ID;
// 	$user_login    = stripslashes($userid->user_login);
// 	$display_name  = stripslashes($userid->display_name);

// 	$return  = '';
// 	$return .= "\t" . '<li>'. $display_name .'</li>' . "\n";

// 	print($return);

    global $wpdb;
    $tablelinkBUE_name = $wpdb->prefix . "Link_Bike_User_Event";

    // Create the WP_User_Query object
    $tb_user_query = new WP_User_Query($userqueryargs);
    $tb_all_users = $tb_user_query->get_results();

    $tb_ourUsers = "<table>"; //"<br><h3>Wir</h3><br>";
    $tb_ourUsers .= "<tr><th>Name</th><th>Fahrten</th></tr>";

    if (!empty($tb_all_users))
    {        
        // loop trough each author
        foreach ($tb_all_users as $tb_cur_user)
        {
            $tb_ourUsers .= "<tr>";
            // get all the user's data
            $tb_cur_user_ID = $tb_cur_user->ID;
            $tb_cur_user = get_userdata($tb_cur_user_ID);
            $tb_cur_firstname = $tb_cur_user->first_name;
            $tb_ourUsers .= "<td>" . $tb_cur_user_ID .": ";
            if(strlen($tb_cur_firstname)==0)
            {
                $tb_ourUsers .= $tb_cur_user->nickname.  "</td>";    
            }
            else
            {
                $tb_ourUsers .= $tb_cur_firstname. "</td>";
            }
            // getting number of participated events

            $sql_query_counter = "SELECT COUNT(eventid) as tourcounter FROM " . $tablelinkBUE_name . " WHERE userid = ". esc_sql($tb_cur_user_ID);
            $BUE_results = $wpdb->get_results($sql_query_counter); 
            $BUE_counter = count($BUE_results);
            if ($BUE_counter == 1)
            {
                $tb_ourUsers .= "<td>" .$BUE_results[0]->tourcounter . "</td>";
            }
            else
            {
                $tb_ourUsers .= "<td>N I X</td>";
            }
            $tb_ourUsers .= "</tr>";
        }
        
    } else {
        $tb_ourUsers .= "No users found\n";
    }
    $tb_ourUsers .= "</table>";

    /* Restore original Post Data */
    wp_reset_postdata();

    //$output = "<p>Hello, This is your another shortcode!</p>"; 
    return $tb_ourUsers;    
    }    

?>
