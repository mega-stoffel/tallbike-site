<?php
$args = array(
    'post_type'      => 'bikes',
    'posts_per_page' => 10,
);
$loop = new WP_Query($args);
while ( $loop->have_posts() ) {
    $loop->the_post();
    ?>
    <div class="entry-content">
        <?php print "test"; the_title(); ?>
        <?php the_content(); ?>
    </div>
    <?php
}
?>