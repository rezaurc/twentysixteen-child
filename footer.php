<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 * 
 * @package twentysixteen
 * @subpackage twentysixteen-child
 * @since Twenty Sixteen Child 1.0.1
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php _e( 'Footer Primary Menu', 'twentysixteenchild' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-menu',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>


			<div class="site-info">
				<?php
					/**
					 * Fires before the twentysixteen footer text for footer customization.
					 *
					 * @since Twenty Sixteen 1.0
					 */
					do_action( 'twentysixteen_credits' );
				?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteenchild' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentysixteenchild' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
