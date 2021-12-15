<?php
/**
 * Template Name: Archive Bikes Template
 *
 * Description: Eine eigene Archivseite für meinen Post Type „bikes“
 */

get_header(); ?>

    <div class="main-wrap" role="main">

        <!-- Darstellung der Bikes -->
        <section id="bikes-listing">
            <?php if ( have_posts() ) : ?>
                <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="column"">
	       <?php require_once( 'bikes-content.php' ); ?>
	    </div>
                <? endwhile; ?>
                </div>
            <?php endif; ?>
        </section>

    </div>

<?php get_footer();