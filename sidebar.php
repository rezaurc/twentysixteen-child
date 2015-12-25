<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area" role="complementary">
            <?php if ( has_nav_menu( 'social' ) ) : ?>
            <nav class="social-navigation" role="navigation" aria-label="<?php _e( 'Footer Social Links Menu', 'twentysixteenchild' ); ?>">
                    <?php
                            wp_nav_menu( array(
                                    'theme_location' => 'social',
                                    'menu_class'     => 'social-links-menu',
                                    'depth'          => 1,
                                    'link_before'    => '<span class="screen-reader-text">',
                                    'link_after'     => '</span>',
                            ) );
                    ?>
            </nav><!-- .social-navigation -->
            <?php endif; ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
