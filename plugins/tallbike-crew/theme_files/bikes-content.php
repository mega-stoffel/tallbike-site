<?php
/**
 * Das Standard-Template zum Anzeigen eines Bikes
 */
?>

<div class="bikes-container" id="bikes-<?php the_ID(); ?>">
    <?php if ( has_post_thumbnail() ) : ?>
    <a href="<?php the_permalink(); ?>">
         <img src="<?php the_post_thumbnail_url( ); ?>">
    </a>
    <?php endif; ?>

    <div class="product-content-section">
        <header>
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        </header>
        <div class="entry-content">
            <?php
                the_product_price(get_the_ID());
                echo '<br />';
                the_excerpt();
            ?>
        </div>
    </div>
</div>