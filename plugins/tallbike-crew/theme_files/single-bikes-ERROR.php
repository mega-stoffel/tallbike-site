<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<article <?php post_class() ?> id="bikes-<?php the_ID(); ?>">
    <div class="row column" id="bikes-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </div>

    <div class="main-wrap" role="main">
        <div class="entry-content">
            <div class="row">
                <div class="medium-6 columns">
                    <?php if(has_post_thumbnail( )) : ?>
                        <a href="<?php the_post_thumbnail_url('large'); ?>">
                                <img src="<?php the_post_thumbnail_url('large'); ?>"/>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="medium-6 columns">
                    <?php the_product_price(get_the_ID()); ?>
                </div>
            </div>

            <div class="row columns">
                <?php the_content(); ?>
            </div>
        </div>

        <footer>
            <?php
                wp_link_pages(
                    array(
                        'before' => '<nav id="page-nav"><p>' . __( 'Bikes:', TRANSLATION_CONST ),
                        'after'  => '</p></nav>',
                    )
                );
            ?>
        </footer>

        <?php comments_template(); ?>

    </div>
</article>
<?php endwhile;?>

<?php get_footer();