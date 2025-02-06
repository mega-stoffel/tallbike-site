<?php

/*
 * Template Name: Archive Bikes Template
 *
 * Description: Eine eigene Archivseite für meinen Post Type "bikes"
 * 
 */

get_header();

wp_reset_postdata();

$queryArgs = array( 
    'post_type'	=> 'bikes',
    'posts_per_page' => 10,
    'orderby'   => 'rand',
    //'orderby'   => 'ID',
    //'order'     => 'ASC',
);

//'meta_key'  => 'events_cf_Date',
//'after'     => 'January 1st, 2022',

$tb_bikes_query = new WP_Query( $queryArgs ); 

if ( $tb_bikes_query->have_posts() ) {
    echo '<ul>';
    while ( $tb_bikes_query->have_posts() ) {
        $tb_bikes_query->the_post();
        echo '<li><img src="' . get_the_post_thumbnail_url(get_the_ID() ,'medium') .'">';
        echo ' <a href="'. get_the_permalink() .'">' . get_the_title() . '</a></li><br>';
    }
    echo '</ul>';
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

// ^^ this works!

// the next chapter kind of works as well, but outputs just one bike....
?>

<?php get_footer();