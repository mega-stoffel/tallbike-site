<?php

/*
* Template File: Archive for the Custom Post Type events
*
* Description: Show a list of all our events
* 
*/
 
get_header();

?>

<div id="content" class="site-content">
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            
<header class="entry-header alignwide">
    <h1 class="entry-title">Touren</h1>
</header>
            
<div class="entry-content">
                
<?php

wp_reset_postdata();

$tbtoday = date('Y-m-d');

// all previous events:
$queryArgs_past = array(
	'post_type'	=> 'events',
    'posts_per_page' => 200,
    'order'     => 'DESC',
    'meta_key'  => 'events_cf_Date',
    'orderby'   => 'events_cf_Date',
    'meta_value'    => $tbtoday,
    'meta_compare'  => '<=',
);

$queryArgs_future = array(
	'post_type'	=> 'events',
    'order'     => 'ASC',
    'meta_key'  => 'events_cf_Date',
    'orderby'   => 'events_cf_Date',
    'meta_value'    => $tbtoday,
    'meta_compare'  => '>=',
);
$tb_events_query = new WP_Query($queryArgs_future);

echo "<p><h2>kommende Touren</h2>";
// The Loop
if ( $tb_events_query->have_posts() ) {
    echo '<ul>';
    echo "\r\n";
    while ( $tb_events_query->have_posts() ) {
        $tb_events_query->the_post();
        $current_eventID = get_the_ID();
        $current_eventtimestamp = esc_attr( get_post_meta($current_eventID, 'events_cf_Date', true ) );
        $eventDateFormatted = strtotime($current_eventtimestamp);
        $current_eventDate = date("d.m.Y",$eventDateFormatted);
        $current_eventTime = date("H:i",$eventDateFormatted);
        //echo '<li>';
        echo ' <a href="'. get_the_permalink() .'">';
        the_title( '<h3 class="entry-title">', '</h3>');
        echo '</a>';
        echo "am " . $current_eventDate . " um " . $current_eventTime ."<br>";
        echo "Treffpunkt: " . get_post_meta($current_eventID, 'events_cf_Place', true ) .'<br>';
        echo "\r\n";
    }
    echo '</ul>';
} else {
    // no posts found
}
echo "</p>";
echo "<p><h2>gefahrene Touren</h2>";
//echo "<p>";
$tb_events_query = new WP_Query($queryArgs_past);

// The Loop
if ( $tb_events_query->have_posts() ) {
    echo '<ul>';
    echo "\r\n";
    while ( $tb_events_query->have_posts() ) {
        $tb_events_query->the_post();
        $current_eventID = get_the_ID();
        //echo '<li>';
        echo ' <a href="'. get_the_permalink() .'">';
        the_title( '<h3 class="entry-title">', '</h3>');
        echo '</a>';
        echo "Treffpunkt: " . get_post_meta($current_eventID, 'events_cf_Place', true ) .'<br>';
        $current_eventtimestamp = esc_attr( get_post_meta($current_eventID, 'events_cf_Date', true ) );
        $eventDateFormatted = strtotime($current_eventtimestamp);
        $current_eventDate = date("d.m.Y",$eventDateFormatted);
        $current_eventTime = date("H:i",$eventDateFormatted);
        echo "am: " . $current_eventDate;
        echo '<br>';
        //echo ' <a href="'. get_the_permalink() .'">' . get_the_title() . '</a></li><br>';
        echo "\r\n";
    }
    echo '</ul><br>';
} else {
    // no posts found
}
echo "</p>";

// if ($the_query->have_posts())
// {
//     while ( have_posts() )
//     {
//         echo '<div class="row">';
//         //echo 'content';
//         the_title( '<h3 class="entry-title">', '</h3>' );
//         echo '</div>';
//     }
//         //  while ( $the_query->have_posts() ) {
        //      $the_query->the_post();
        //      echo '<li>' . get_the_title() . '</li>';
        //  }

// 	echo '<header class="entry-header alignwide">';
// 		//twenty_twenty_one_post_thumbnail();
// 	echo '</header>'; //<!-- .entry-header -->

//     //echo '<ul>';
//     //echo '</ul>';
// } else {
//     // no posts found
// }
//echo '</p>';
/* Restore original Post Data */
//wp_reset_postdata();

//'meta_key' => 'ecents_cf_Place',
//'meta_value' => 'Marienplatz',
    // <div class="main-wrap" role="main">
    //     <!-- Darstellung der Events -->
    //     <section id="events-listing">
    //         <?php if ( $the_query->have_posts() ) : 
    //             <div class="row">
    //             <?php while ( have_posts() ) : the_post(); 
    //                 <div class="column">
	//        <?php require_once( 'events-content.php' ); 
	//     </div>
    //             <? endwhile; 
    //             </div>
    //         <?php endif; 
    //     </section>

    // </div>

get_footer();