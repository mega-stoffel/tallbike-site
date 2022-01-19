<?php

/*
 * Template Name: Archive Bikes Template
 *
 * Description: Eine eigene Archivseite für meinen Post Type "bikes"
 * 
 */

get_header();

$queryArgs = array( 
    'post_type'	=> 'bikes',
    'posts_per_page' => 10,
    'orderby'   => 'rand',
    //'orderby'   => 'ID',
    //'order'     => 'ASC',
);

//'meta_key'  => 'events_cf_Date',
//'after'     => 'January 1st, 2022',

$the_query = new WP_Query( $queryArgs ); 

if ( $the_query->have_posts() ) {
    echo '<ul>';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        echo '<li>' . get_the_title() . '</li>';
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

<div class="main-wrap" role="main">
        <!-- Darstellung der Bikes -->
        <section id="bikes-listing">
            <?php if ( $the_query->have_posts() ) : ?>
                <div class="row">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="column">
            	       <?php require_once( 'bikes-content.php' ); ?>
	                </div>
                <? endwhile; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>

<?php get_footer();