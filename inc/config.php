<?php
/**
 * Site configuration for hm-core and hm-starter.
 */

namespace Woodpro;

add_filter( 'hm/config', function ( array $config ) {
	// Block colour themes (output as `theme--{value}`): set in src/scss/0-settings/_themes.scss.
	$config['themes']     = [
		'none'  => 'None',
		'dark'  => 'Black',
		'light' => 'Grey',
	];
	$config['icons_path']   = 'assets/icons';
	$config['field_labels'] = 'static'; // labels above the fields (Figma forms)
	$config['dropdown_icon'] = 'carret-down'; // ⌄ on Items with SubItems, text and button (hm-core menus)
	$config['dropdown_open'] = 'hover';       // open dropdowns on hover (click still works, touch screens click)
	$config['dropdown_morph'] = true;         // one box slides from one Item's panel to the next
	return $config;
} );

/**
 * Page colour theme (body class `theme-{name}`). One for the whole site to start with.
 */
add_filter( 'hm_starter/page_theme', fn() => 'default' );

/**
 * Header layout: 'horizontal' (logo left, menu right) or 'vertical' (logo, then menu under it).
 * Desktop only; mobile keeps logo + burger. Class `site-header--{layout}` (parts/site-header.php).
 * Set in Appearance › Customize › Header.
 */
add_filter( 'woodpro/header_layout', fn() => get_theme_mod( 'header_layout', 'horizontal' ) );

add_action( 'customize_register', function ( \WP_Customize_Manager $wp_customize ) {
	$wp_customize->add_section( 'woodpro_header', [
		'title'    => __( 'Header', 'woodpro' ),
		'priority' => 30,
	] );
	$wp_customize->add_setting( 'header_layout', [
		'default'           => 'horizontal',
		'sanitize_callback' => fn( $value ) => 'vertical' === $value ? 'vertical' : 'horizontal',
	] );
	$wp_customize->add_control( 'header_layout', [
		'label'       => __( 'Layout', 'woodpro' ),
		'description' => __( 'Desktop only: mobile always shows logo + burger.', 'woodpro' ),
		'section'     => 'woodpro_header',
		'type'        => 'radio',
		'choices'     => [
			'horizontal' => __( 'Horizontal (logo left, menu right)', 'woodpro' ),
			'vertical'   => __( 'Vertical (logo, then menu)', 'woodpro' ),
		],
	] );
} );

/**
 * Storybook (hm-core): theme parts rendered by `npm run storybook:fixtures`
 * (site-header and site-footer are included by default). Stories: src/stories/.
 */
add_filter( 'hm/storybook/parts', fn( array $parts ): array => $parts );
