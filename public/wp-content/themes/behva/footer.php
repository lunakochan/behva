<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package behva
 */

$footer = get_field( 'footer', 'option' );
?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer-container">
				<div class="group-top">
					<div class="blog-descrption">
						<?php
						bloginfo('description');
						?>
					</div>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-footer',
							'menu_id'        => 'footer-menu',
						)
					);
					?>
				</div>
				<div class="logo">
					<?php
					the_custom_logo();
					?>
				</div>
				<div class="group-bottom">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-terms-privacy',
						'menu_id'        => 'terms-privacy-menu',
					)
				);
				if ( ! empty( $footer['copyright'] ) ) {
					?>
					<div class="copyright">
						<?php echo esc_html( $footer['copyright'], 'behva' ); ?>
					</div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
