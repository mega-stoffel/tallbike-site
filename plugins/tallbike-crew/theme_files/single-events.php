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
<div class="entry-content">
    
<?php

        //getting the event's date and time:

        $eventTimestamp=esc_attr($post->events_cf_Date);
        //echo "<br><b>my Date</b> " . $eventTimestamp ."<br>";
        $eventDateFormatted = strtotime($eventTimestamp);
        $eventDate = date("d.m.Y",$eventDateFormatted);
        $eventTime = date("H:i",$eventDateFormatted);
        //echo $eventDate . " and also " . $eventTime;
        $tbadmin = false;
        $tbeditor = false;

        if( is_user_logged_in() )
        {
            $tbuser = wp_get_current_user(); // getting & setting the current user 
            $tbroles = ( array ) $tbuser->roles;
            foreach ($tbroles as $tbrole)
            {
                switch ($tbrole) {
                    case "administrator":
                        $tbadmin = true;
                        break;
                    case "editor":
                        $tbeditor = true;
                        break;
                    }
            }
        }

        $current_eventID=get_the_ID();

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
        $current_tbuser = get_current_user_id();
        $tablelinkBUE_name = $wpdb->prefix . "Link_Bike_User_Event";

        //get all entries for this particular event:
        $BUE_results = $wpdb->get_results("SELECT * FROM " . $tablelinkBUE_name . " WHERE eventid = ". esc_sql($current_eventID) ." ORDER BY RAND()"); 
        $BUE_counter = count($BUE_results);
        $userAlreadyExistshere = false;
        $userIsInList = false;

        // $all_meta_for_user = get_user_meta(1);
        // print_r( $all_meta_for_user ) . "<br>";

        echo "<table>\n";
        for($i=-1;$i<$BUE_counter;$i++)
        {
            if ($i<0)
            {
                echo "<tr>"; //<th>Event</th>
                echo '<th width="42px"></th><th>Person</th><th>Bike</th><th>Punkte</th></tr>';
            }
            else
            {
                echo "<tr>";
                //echo "<td>" . $BUE_results[$i]->eventid . "</td>";
                $tbuser_id = $BUE_results[$i]->userid;
                $tbbike_id = $BUE_results[$i]->bikeid;
                if ($current_tbuser == $tbuser_id)
                {
                    $userAlreadyExistshere = true;
                    $userIsInList = true;
                }
                else
                {
                    $userAlreadyExistshere = false;
                }
                $tbfirstname = get_user_meta($tbuser_id, 'first_name', true);
                // get user's name:
                if ($tbfirstname == '')
                    $tbfirstname = get_user_meta($tbuser_id, 'nickname', true);
                echo '<td align="center">';
                if ($userAlreadyExistshere || $tbadmin)
                {
                    $nonce_rm = wp_create_nonce("tb_removeme_tour_nonce");
                    $link = admin_url('admin-ajax.php?action=tb_removeme_tour&post_id='.$post->ID.'&tbuser='.$tbuser_id.'&nonce='.$nonce_rm);
                    echo '<a class="remove_user" data-nonce="' . $nonce_rm . '" data-post_id="' . $post->ID . '" tbuser="' . $tbuser_id.'"';
                    echo ' href="' . $link . '"><img src="/wp-content/plugins/tallbike-crew/pictures/x.png" width="14" title="doch nicht dabei"></a>&nbsp;';
                }
                echo '</td><td>' . $tbfirstname . '</td>';
                // get bike's name:
                if ($tbbike_id == 0)
                    { $tbbike_name = "fehlt noch!"; }
                else
                    { $tbbike_name = get_the_title($BUE_results[$i]->bikeid); }
                echo "<td>" . $tbbike_name . "</td>";
                echo "<td>" . $BUE_results[$i]->points . "</td></tr>\n";   
            }
        }
        echo "</table>\n";
        
        // Missing: Add yourself (or anyone else, if "Admin" or "Editor") to this list:
        echo "<p>";
        
        //Alternative: if (get_current_user_id() > 0)
        if( is_user_logged_in() )
        {
            // Eintragen-Link nicht anzeigen, wenn schon bei der Tour dabei:
            //if ($userAlreadyExistshere != true)
            if ($userIsInList != true)
            {
                $nonce = wp_create_nonce("tb_addme_tour_nonce");
                $link = admin_url('admin-ajax.php?action=tb_addme_tour&post_id='.$post->ID.'&tbuser='.$current_tbuser.'&nonce='.$nonce);
                echo '<br><a class="user_vote" data-nonce="' . $nonce . '" data-post_id="' . $post->ID . '" tbuser="' . $current_tbuser.'"';
                echo ' href="' . $link . '">Ich war dabei!</a></p>';
            }
        }
        else {
            echo "Falls Du dabei warst, <a href=\"/wp-admin\">meld dich doch an</a> und trage dich in die Liste ein!";
        }
        echo "</p>";
		// -------------------------------------

        // Comments??
        // https://stackoverflow.com/questions/12134183/how-to-add-comments-to-a-wordpress-theme
        
        //some browsing to the previous and next tours:
        echo "<p>";

        $tbtoday = date('Y-m-d\TH:i');

        $queryArgsNext = array( 
            'post_type'	=> 'events',
            'posts_per_page' => 1,
            'order'     => 'ASC',
            'orderby'   => 'events_cf_Date',
            'meta_query' => array(
                'relation' => 'AND',
                 array(
                     'key'     => 'events_cf_Date',
                     'value'   => $eventTimestamp,
                     'compare' => '>'
                 ),
                 array(
                    'key'     => 'events_cf_Date',
                    'value'   => $tbtoday,
                    'compare' => '<='
                )
             )
        );

        $queryArgsPrev = array( 
            'post_type'	=> 'events',
            'posts_per_page' => 1,
            'order'     => 'DESC',
            'meta_key'  => 'events_cf_Date',
            'orderby'   => 'events_cf_Date',
            'meta_value'    => $eventTimestamp,
            'meta_compare'  => '<',
        );

        $tb_events_query1 = new WP_Query( $queryArgsNext );

        if ( $tb_events_query1->have_posts() )
        {
            $tb_events_query1->the_post();
            $nextLink = get_the_permalink();
            $nextEventTitle = get_the_title();
        }

        $tb_events_query2 = new WP_Query( $queryArgsPrev );

        if ( $tb_events_query2->have_posts() )
        {
            $tb_events_query2->the_post();
            $previousLink = get_the_permalink();
            $previousEventTitle = get_the_title();
        }

        if (isset($previousLink))
            echo "<div align=\"center\">&laquo; <a href=\"".$previousLink. "\">".$previousEventTitle."</a>";
        if (isset($previousLink) && isset($nextLink))
        {
            echo "&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;";
        }
        else
        {
            echo "<div align=\"center\">";
        }
        if (isset($nextLink))
            echo "<a href=\"".$nextLink. "\">".$nextEventTitle."</a> &raquo;";
        echo "</p>";

        wp_reset_postdata();

    ?>
	</div><!-- .entry-content -->

</article>

<?php get_footer();
