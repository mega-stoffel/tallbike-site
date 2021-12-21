<?php
/**
 * Template Name: Archive Bikes Template
 *
 * Description: Eine eigene Archivseite für meinen Post Type "events"
 */
 
get_header(); ?>

    <div class="main-wrap" role="main">

        <!-- Darstellung der Ecents -->
        <section id="events-listing">
            <?php if ( have_posts() ) : ?>
                <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="column"">
	       <?php require_once( 'events-content.php' ); ?>
	    </div>
                <? endwhile; ?>
                </div>
            <?php endif; ?>
        </section>

    </div>

<?php get_footer();