<?php

global $wpdb;

$table_name = $wpdb->prefix . 'Badges';

// this will get the data from your table
$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name" );

$outputheader = '<div class="wrap">
    <h2>Orden</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Zeit</th>
            <th>Text</th>
        </tr>';
print $outputheader;

foreach ($retrieve_data as $retrieved_data){ 
    $f_id = $retrieved_data->id;
    $f_name = $retrieved_data->name;
    $f_time = $retrieved_data->time;
    $f_text = $retrieved_data->text;
    $outputline = '<tr>
                    <td>'. $f_id .'</td>
                    <td>'. $f_name .'</td>
                    <td>'. $f_time .'</td>
                    <td>'. $f_text .'</td>
                </tr>';
    print $outputline;
    }

print '</table>
        </div>';

?>