<?php

// I got this basic information from this page:
// https://www.inkthemes.com/learn-how-to-create-shortcodes-in-wordpress-plugin-with-examples/
// remember the include in the startpage.php

function tb_future_events(){

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
$tbtoday = date('Y-m-d');

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

?>