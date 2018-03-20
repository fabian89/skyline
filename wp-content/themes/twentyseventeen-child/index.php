<?php 
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
		$args = array(
			
			post_type => array('product','films')
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
			<div class="products">
				
			<a href="<?php the_permalink() ?>"><?php the_title()?></a>
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
			</div>
			
			<?php
			}
		} else {

		}
		wp_reset_postdata();
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer(); ?>