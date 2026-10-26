<?php
/**
 * Site header: logo, primary menu (desktop), burger + panel (mobile).
 * Colours: --header-* tokens (src/scss/3-components/_header.scss, page themes in 0-settings/_themes.scss).
 */

use function HM\Core\icon;
?>
<header class="site-header">
	<div class="container site-header__inner">
		<a class="site-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Home', 'woodpro' ); ?>">
			<?php if ( is_readable( get_theme_file_path( 'assets/images/logo.svg' ) ) ) : ?>
				<?php echo file_get_contents( get_theme_file_path( 'assets/images/logo.svg' ) ); // phpcs:ignore -- theme file. ?>
			<?php else : ?>
				<span class="site-header__name"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
		</a>

		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Main navigation', 'woodpro' ); ?>">
			<?php
			wp_nav_menu( [
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'site-nav__list',
				'fallback_cb'    => false,
				'depth'          => 2,
			] );
			?>
		</nav>

		<button class="site-header__burger" type="button" aria-controls="site-nav" aria-expanded="false">
			<span class="u-sr-accessible"><?php esc_html_e( 'Menu', 'woodpro' ); ?></span>
			<?php echo icon( 'burger' ); // phpcs:ignore -- inline SVG. ?>
		</button>
	</div>
</header>
