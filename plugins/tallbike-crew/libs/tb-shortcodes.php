<?php

//
// remember to include the function-name in the startpage.php
//

# # # # # # # # # # # # # # #
# Function: Future Events
# # # # # # # # # # # # # # #

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
        'order'     => 'ASC',
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

# # # # # # # # # # # # # # #
# Function: Previous Events
# # # # # # # # # # # # # # #

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

# # # # # # # # # # # # # # #
# Function: All Users
# # # # # # # # # # # # # # #

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
    $tableUserExtend_name = $wpdb->prefix . "Users_Extend";
    $tableUsers_name = $wpdb->prefix . "users";

    // Create the WP_User_Query object
    //$tb_user_query = new WP_User_Query($userqueryargs);
    //$tb_all_users = $tb_user_query->get_results();

    //$sql_query_counter = "SELECT COUNT(eventid) as tourcounter FROM " . $tablelinkBUE_name . " WHERE userid = ". esc_sql($tb_cur_user_ID);
    // $sql_query_counter = "SELECT
    //     users.id as UserID, BUE.userid as BUEUser, userext.userid as UserExt
    //     FROM " . $tablelinkBUE_name . " AS BUE, wp_users as users, ". $tableUserExtend_name . " as userext";
    $sql_query_counter2 = "SELECT
        BUE.userid as BUEUser, BUE.eventid as BUEEvent, users.id as UserID, users.user_nicename as nicename, users.display_name as displayname
        FROM " . $tablelinkBUE_name . " AS BUE
        JOIN " . $tableUsers_name . " AS users ON BUE.userID = users.id WHERE UserID NOT IN (1)";
        //JOIN " .$tableUserExtend_name. " AS UserExt ON BUE.UserID = UserExt.userid)";// WHERE (visible = 1)";
    
    
    //users.ID as UserID, COUNT(BUE.eventid) AS event_count

    $sql_query_join1 = "SELECT users.ID as UID, users.user_nicename as nicename, users.display_name as displayname, count(BUE.eventid) as counter 
    FROM " .$tableUsers_name . " AS users
    LEFT JOIN " . $tablelinkBUE_name . " as BUE ON users.ID = BUE.userid
    WHERE users.id NOT IN (1,2)
    GROUP BY 1
    ORDER BY counter DESC";

    $joined_results = $wpdb->get_results($sql_query_join1); 
    $joined_counter = count($joined_results);

    if ($joined_counter == 0)
        exit;
    $i=0;

    if (!empty($joined_results))
    {        
        $tb_ourUsers = "<p><table>"; //"<br><h3>Wir</h3><br>";
        $tb_ourUsers .= "<tr><th>Name</th><th>Fahrten</th></tr>";

        foreach ($joined_results as $joined_result)
        {
            $tb_ourUsers .= "<tr><td>";
            $tb_displayname = $joined_results[$i]->displayname;
            if (strlen($tb_displayname)!=0)
            {
                $tb_ourUsers .= $tb_displayname;
            }
            else
            {
                $tb_ourUsers .= $joined_results[$i]->nicename;
            }
            $tb_ourUsers .= "</td>";
            $tb_ourUsers .= "<td>" . $joined_results[$i++]->counter ."</td>";
            $tb_ourUsers .= "</tr>";
        }
    }
    else
    {
        $tb_ourUsers .= "<tr><td>No users found</td><td></td></tr>";
    }
    $tb_ourUsers .= "</table></p>";

    wp_reset_postdata();

    // $tb_ourUsers .= "<p><table>"; //"<br><h3>Wir</h3><br>";
    // $tb_ourUsers .= "<tr><th>Name</th><th>Fahrten</th></tr>";

    // if (!empty($tb_all_users))
    // {        
    //     // loop trough each author
    //     foreach ($tb_all_users as $tb_cur_user)
    //     {
    //         $tb_ourUsers .= "<tr>";
    //         // get all the user's data
    //         $tb_cur_user_ID = $tb_cur_user->ID;
    //         $tb_cur_user = get_userdata($tb_cur_user_ID);
    //         $tb_cur_firstname = $tb_cur_user->first_name;
    //         $tb_ourUsers .= "<td>" . $tb_cur_user_ID .": ";
    //         if(strlen($tb_cur_firstname)==0)
    //         {
    //             $tb_ourUsers .= $tb_cur_user->nickname.  "</td>";    
    //         }
    //         else
    //         {
    //             $tb_ourUsers .= $tb_cur_firstname. "</td>";
    //         }
    //         // getting number of participated events

    //         $sql_query_counter = "SELECT COUNT(eventid) as tourcounter FROM " . $tablelinkBUE_name . " WHERE userid = ". esc_sql($tb_cur_user_ID);
    //         $BUE_results = $wpdb->get_results($sql_query_counter); 
    //         $BUE_counter = count($BUE_results);
    //         if ($BUE_counter == 1)
    //         {
    //             $tb_ourUsers .= "<td>" .$BUE_results[0]->tourcounter . "</td>";
    //         }
    //         else
    //         {
    //             $tb_ourUsers .= "<td>N I X</td>";
    //         }
    //         $tb_ourUsers .= "</tr>";
    //     }
        
    // } else {
    //     $tb_ourUsers .= "<tr><td>No users found</td><td></td></tr>";
    // }
    // $tb_ourUsers .= "</table></p>";

    // /* Restore original Post Data */
    // wp_reset_postdata();

    return $tb_ourUsers;    
    }    

# # # # # # # # # # # # # # #
# Function: Random Image
# # # # # # # # # # # # # # #

function tb_random_image()
    {
        wp_reset_postdata();
    
        // Query Definition, especially for meta values and their comparision
        // https://developer.wordpress.org/reference/classes/wp_query/
        $queryArgsImage = array(
            'post_type' => 'attachment',
            'post_status' => 'any',
            'orderby' => 'rand', // select image by random.
            'posts_per_page' => 1,
            'post_mime_type' => array('image/jpg', 'image/jpeg')
        );
    
        $tb_randImage = "<h3>zuf&auml;lliges Bild</h3>";
    
        $tb_images = get_posts($queryArgsImage);

        //$tb_images_query = new WP_Query($queryArgsImage);
    
        foreach ($tb_images as $tb_image)
        {
            $image_link = wp_get_attachment_url($tb_image->ID); // random image link.
            //$image_title = $tb_image->post_title; // random image title, you can remove it, not important.
            //$image_caption = $tb_image->post_excerpt; // random image caption, you can remove it, not important.
            $tb_randImage .= '<img src="'.$image_link.'">'; // display random image        

        }

        /*$tb_randImage .= "<br><h3>zuf&auml;lliges Bild 2</h3><br>";
        $tb_random_query_events = new WP_Query( 
            array( 
              'post_type' => 'events', 
              'posts_per_page' => -1,
              'orderby' => 'rand',
              'fields' => 'ids'
            ) 
          );
          $tb_image_query = new WP_Query( 
            array( 
              'post_type' => 'attachment', 
              'post_status' => 'inherit', 
              'post_mime_type' => 'image', 
              'posts_per_page' => 1, 
              'post_parent__in' => $tb_random_query_events->posts, 
              'order' => 'rand' 
            ) 
          );
          //doesn't seem to get into this if and while. :-/
          if($tb_image_query->have_posts())
          {
            $tb_randImage .= "im if";
            while( $tb_image_query->have_posts() ) {
                $tb_randImage .= "im while";
                $tb_image_query->the_post();
                $imgurl = wp_get_attachment_url( get_the_ID() );
                
                $tb_randImage .= '<p><img src="'.$imgurl.'"></p>';
            }
          }
        */

        /*if ($tb_image_query->have_posts())
        {
            while ($tb_image_query->have_posts())
            {
                $image = $tb_image_query->the_post();
                
                //$current_eventDate = date('d.M.Y', $current_eventtimestamp);
                //$tb_randImage .=  '<li><h4>'. get_the_title() . '</h4>';
                //$tb_randImage .=  "Wann? " . $current_eventDate . " um " . $current_eventTime ." Uhr<br>";
                //$tb_randImage .=  "Wo? " . esc_attr( get_post_meta($current_eventID, 'events_cf_Place', true ) ) . "</li>";

                $image_link = wp_get_attachment_url($image->ID); // random image link.
                $image_title = $image->post_title; // random image title, you can remove it, not important.
                $image_caption = $image->post_excerpt; // random image caption, you can remove it, not important.
                //echo '<p><img src="'.$image_link.'" title="'.$image_title.'" alt="'.$image_caption.'"></p>'; // display random image        
            }
        } 
        else
        {
            $tb_randImage = "<p>kein Bild gefunden</p>";
        }*/

        /* Restore original Post Data */
        wp_reset_postdata();
    
        return $tb_randImage;
    }

// I got this basic information from this page:
// https://www.inkthemes.com/learn-how-to-create-shortcodes-in-wordpress-plugin-with-examples/

?>
