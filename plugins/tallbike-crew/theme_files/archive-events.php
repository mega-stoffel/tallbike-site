<?php

/*
 * Template Name: Archive Events Template
 *
 * Description: Eine eigene Archivseite für meinen Post Type "events"
 * 
 */
 
get_header();

wp_reset_postdata();

$today = getdate();

$queryArgs = array(
	'post_type'	=> 'events',
    'meta_key'  => 'events_cf_Date',
    'before'    => 'January 1st, 2022',
    'orderby'   => 'events_cf_Date',
    'order'     => 'ASC',
);

$the_query = new WP_Query($queryArgs);

// The Loop
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

//'meta_key' => 'ecents_cf_Place',
//'meta_value' => 'Marienplatz',
?>
some output!
    <div class="main-wrap" role="main">
        <!-- Darstellung der Events -->
        <section id="events-listing">
            <?php if ( $the_query->have_posts() ) : ?>
                <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="column">
	       <?php require_once( 'events-content.php' ); ?>
	    </div>
                <? endwhile; ?>
                </div>
            <?php endif; ?>
        </section>

    </div>

<?php get_footer();