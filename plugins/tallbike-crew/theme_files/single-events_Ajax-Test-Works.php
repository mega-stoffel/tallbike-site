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

        $current_eventID=get_the_ID();
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

        the_content();

		?>

        
        <p> <strong>L&auml;nge: </strong> <?php echo esc_attr( get_post_meta($current_eventID, 'events_cf_Length', true ) ); ?>km<br>
        <strong>Treffpunkt: </strong> <?php echo esc_attr( get_post_meta($current_eventID, 'events_cf_Place', true ) ); ?></p>
		
        <?php
		// -------------------------------------
		// Missing: The list of all people, who attended, this event:
        global $wpdb;
        $tablelinkBUE_name = $wpdb->prefix . "Link_Bike_User_Event";

        //get all entries for this particular event:
        $BUE_results = $wpdb->get_results("SELECT * FROM " . $tablelinkBUE_name . " WHERE eventid = ". esc_sql($current_eventID)); 
        
        foreach ( $BUE_results as $BUE_result)
        {
		    echo "eventID: " . $BUE_result->eventID . "<br>";
            echo "bikeID: " . $BUE_result->bikeID . "<br>";
            echo "userID: " . $BUE_result->userID . "<br>";
            echo "points: " . $BUE_result->points . "<br>";
	    };

        /*
        Users: 1, 2
        Events: 6,38,41
        Bikes: 25,40
        */ 
        
        // Missing: Add yourself (or anyone else, if Admin or Editor) to this list:
        $current_tbuser = get_current_user_id();
        echo "<p>";
        //Alternative: if (get_current_user_id() > 0)

        if( is_user_logged_in() )
        {
            $tbuser = wp_get_current_user(); // getting & setting the current user 
	        $tbroles = ( array ) $tbuser->roles;
            foreach ($tbroles as $tbrole)
            {
                if ($tbrole == "administrator" || $tbrole == "editor")
                {
                    $tbadmin = true;
                }
                else
                {
                    $tbadmin = false;
                }
                echo $tbrole . " for my user. And tbadmin: " . var_dump($tbadmin) . "<br>";
            }
            echo "yes, logged in: " . $current_tbuser;
            ?>

            <div class="control-group">
                <input type="text" required="required" name="title" class="pref2" placeholder="Input Title">
                <button class="pref2" id="next">Next</button>
            </div>

<?php
$votes = get_post_meta($post->ID, "events_cf_Length", true);
$votes = ($votes == "") ? 0 : $votes;
?>
<p class="vote_counter"></p>
<p>This post has <div id='vote_counter'><?php echo $votes ?></div> votes</p>

<?php
$nonce = wp_create_nonce("tb_addme_tour_nonce");
$link = admin_url('admin-ajax.php?action=tb_addme_tour&post_id='.$post->ID.'&nonce='.$nonce."4");
echo '<a class="user_vote" data-nonce="' . $nonce . '" data-post_id="' . $post->ID . '" href="' . $link . '">vote for this article</a>';

?>
            
            <!-- <form action="" id="postvalues" method="post">
            <input type="text" name="organizationname" id="organizationname" value="">
            <input type="text" name="organizationname" id="organizationname" value="">
            <input type="text" name="organizationname" id="organizationname" value="">
            <input type="text" name="organizationname" id="organizationname" value="">
            </form> -->
            <?php
        }
        else {
            echo "Falls Du dabei warst, meld dich doch an und trage dich in die Liste ein!";
        }
        echo "</p>";
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
