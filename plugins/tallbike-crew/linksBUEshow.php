<?php

global $wpdb;

$table_name = $wpdb->prefix . 'Link_Bike_User_Event';

// this will get the data from your table
$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name" );

$outputheader = '<div class="wrap">
    <h2>Wer war mit welchem Rad dabei?</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Bike</th>
            <th>Event</th>
            <th>Text</th>
        </tr>';
print $outputheader;

foreach ($retrieve_data as $retrieved_data){ 
    $f_id = $retrieved_data->id;
    $f_userid = $retrieved_data->userid;
    $f_bikeid = $retrieved_data->bikeid;
    $f_eventid = $retrieved_data->eventid;
    $f_text = $retrieved_data->text;
    $outputline = '<tr>
                    <td>'. $f_id .'</td>
                    <td>'. $f_userid .'</td>
                    <td>'. $f_bikeid .'</td>
                    <td>'. $f_eventid .'</td>
                    <td>'. $f_text .'</td>
                </tr>';
    print $outputline;
    }

print '</table>
        </div>';

?>