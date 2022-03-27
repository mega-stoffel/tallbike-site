<?php

/*
 * Template File: Archive for the Custom Post Type bikes
 *
 * Description: Show a list of all our bikes
 * 
 */

get_header();
?>

<div id="content" class="site-content">
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            
<header class="entry-header alignwide">
    <h1 class="entry-title">R&auml;der</h1>
</header>
            
<div class="entry-content">

<?php

wp_reset_postdata();

$queryArgs = array( 
    'post_type'	=> 'bikes',
    'posts_per_page' => 15,
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
        $current_eventID = get_the_ID();
        echo '<li><img src="' . get_the_post_thumbnail_url(get_the_ID() ,'medium') .'">';
        echo ' <a href="'. get_the_permalink() .'">' . get_the_title() . '</a></li><br>';
    }
    echo '</ul>';
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();

?>

<?php get_footer();