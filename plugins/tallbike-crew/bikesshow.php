<?php

print "Some Output";

global $wpdb;

$table_name = $wpdb->prefix . 'Bikes';

// this will get the data from your table
$retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name" );

$outputheader = '<div class="wrap">
    <h2>Unsere Räder</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>';
print $outputheader;

foreach ($retrieve_data as $retrieved_data){ 
    $f_id = $retrieved_data->id;
    $f_name = $retrieved_data->name;
    $outputline = '<tr>
                    <td>'. $f_id .'</td>
                    <td>'. $f_name .'</td>
                </tr>';
    print $outputline;
    }

print '</table>
        </div>';

?>