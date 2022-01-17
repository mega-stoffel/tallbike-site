<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php

        //getting the event's date and time:

        $eventTimestamp=esc_attr($post->events_cf_Date);
        //echo "<br><b>my Date</b> " . $eventTimestamp ."<br>";
        $eventDateFormatted = strtotime($eventTimestamp);
        $eventDate = date("d.m.Y",$eventDateFormatted);
        $eventTime = date("H:i",$eventDateFormatted);
        //echo $eventDate . " and also " . $eventTime;

        $current_ID=get_the_ID();
    /*
	<header class="entry-header alignwide">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php twenty_twenty_one_post_thumbnail(); ?>
	</header><!-- .entry-header --> */
?>

	<div class="entry-content">
    <?php
        $eventTitle = esc_html(get_the_title());
        echo "<p><h2>" . $eventTitle ."</h2></p>";
        //echo the_title('<h4 class="entry-title">','</h4>');
        echo "<p>" . $eventDate . " um " . $eventTime . "</p>";
    ?>
    
        <?php

        the_content();
		
		?>
		<p> <strong>L&auml;nge: </strong> <?php echo esc_attr( get_post_meta($current_ID, 'events_cf_Length', true ) ); ?>km<br>
        <strong>Treffpunkt: </strong> <?php echo esc_attr( get_post_meta($current_ID, 'events_cf_Place', true ) ); ?></p>
		<br>
		
        <?php
		// -------------------------------------
		// Missing: The list of all people, who attended, this event:

		// -------------------------------------

        //some browsing to the previous and next tours:
        echo "<p>";
        $previousLink = get_previous_post_link();
        //Todo: only show next link, if it's not in the future.
        $nextLink = get_next_post_link();
        echo "<div align=\"center\">" . $previousLink;
        //echo "laenge:" . strlen($previousLink) . "next" . strlen($nextLink);
        if (strlen($previousLink)>0 && strlen($nextLink)>0)
            echo "&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;";
        echo $nextLink . "</div>";
        echo "</p>";

        //wp_link_pages(
		//	array(
		//		'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'twentytwentyone' ) . '">',
		//		'after'    => '</nav>',
		//		/* translators: %: Page number. */
		//		'pagelink' => esc_html__( 'Page %', 'twentytwentyone' ),
		//	)
		//);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
		<?php twenty_twenty_one_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
