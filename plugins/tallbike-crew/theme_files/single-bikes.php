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

	<header class="entry-header alignwide">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php //twenty_twenty_one_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();
		$current_ID=get_the_ID();
		?>
		<p>
		<strong>Erbauer:in: </strong> <?php echo esc_attr( get_post_meta($current_ID, 'bikes_cf_Creator', true ) ); ?>
		<br>
		<strong>Schwierigkeit: </strong> <?php echo esc_attr( get_post_meta($current_ID, 'bikes_cf_Complexity', true ) );?>
		</p>

		<?php
		// -------------------------------------
		// Missing: The list of all events, this bike was part of:

		// -------------------------------------
		?>
	</div><!-- .entry-content -->

</article>

<?php get_footer();