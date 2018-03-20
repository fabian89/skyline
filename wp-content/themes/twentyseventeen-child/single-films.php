<?php
/**
 * The template for displaying all single films
 *
 */

get_header(); 
/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<form action="" method="post">
					<input name="add-to-cart" type="hidden" value="<?php echo $post->ID ?>" />
					<input name="quantity" type="number" value="1" min="1"  />
					<input name="submit" type="submit" value="Add to cart" />
				</form>
			<?php
				// check for plugin using plugin name
				if ( is_plugin_active( 'custom-wishlist/custom-wishlist.php' ) ) {
				 echo do_shortcode('[cwl_button]');
				}
				?>
			<?php endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
