<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package cbarnes_dev
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="container" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'cbarnes_dev_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'cbarnes_dev' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'cbarnes_dev' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'cbarnes_dev' ), 'cbarnes_dev', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>