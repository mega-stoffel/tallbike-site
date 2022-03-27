<?php

//
// My template for the "WIR" page
//

get_header();

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

// Create the WP_User_Query object
$tb_user_query = new WP_User_Query($userqueryargs);
$tb_all_users = $tb_user_query->get_results();

$tb_ourUsers = ""; //"<br><h3>Wir</h3><br>";

if (!empty($tb_all_users))
{
    $tb_ourUsers .= '<ul>';
    // loop trough each author
    foreach ($tb_all_users as $tb_cur_user)
    {
        // get all the user's data
        $tb_cur_user = get_userdata($tb_cur_user->ID);
        $tb_cur_firstname = $tb_cur_user->first_name;
        if(strlen($tb_cur_firstname)==0)
        {
            $tb_ourUsers .= '<li>'.$tb_cur_user->nickname.'</li>';    
        }
        else
        {
            $tb_ourUsers .= '<li>'.$tb_cur_firstname.'</li>';
        }
    }
    $tb_ourUsers .= '</ul>';
} else {
    $tb_ourUsers .= 'No users found';
}

/* Restore original Post Data */
wp_reset_postdata();

//$output = "<p>Hello, This is your another shortcode!</p>"; 
return $tb_ourUsers;    

get_footer();

?>
