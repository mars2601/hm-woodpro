<?php
/**
 * Site header: logo, primary menu (desktop), burger + panel (mobile).
 * Layout: woodpro/header_layout filter (inc/config.php), horizontal or vertical.
 * Colours: --header-* tokens (src/scss/3-components/_header.scss, page themes in 0-settings/_themes.scss).
 */

use function HM\Core\icon;

$layout = 'vertical' === apply_filters( 'woodpro/header_layout', 'horizontal' ) ? 'vertical' : 'horizontal';
// Vertical: narrower container (hm-starter .container--small).
$container = 'vertical' === $layout ? 'container container--small' : 'container';
?>
<header class="site-header site-header--<?php echo esc_attr( $layout ); ?>">
	<div class="<?php echo esc_attr( $container ); ?>">
		<div class="site-header__inner">
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
					'depth'          => 3,
				] );
				?>
			</nav>

			<button class="site-header__burger" type="button" aria-controls="site-nav" aria-expanded="false">
				<span class="u-sr-accessible"><?php esc_html_e( 'Menu', 'woodpro' ); ?></span>
				<?php echo icon( 'burger' ); // phpcs:ignore -- inline SVG. ?>
			</button>
		</div>
	</div>
</header>
