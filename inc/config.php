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
 * Default for the whole site: Appearance › Customize › Header.
 * Per page: the "Header layout" field in the page's sidebar (Default / Horizontal / Vertical).
 */
add_filter( 'woodpro/header_layout', function () {
	$page = is_singular() && function_exists( 'get_field' ) ? get_field( 'header_layout', get_queried_object_id() ) : '';
	return in_array( $page, [ 'horizontal', 'vertical' ], true ) ? $page : get_theme_mod( 'header_layout', 'horizontal' );
} );

// The per-page field (ACF, registered in code: nothing to import).
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	acf_add_local_field_group( [
		'key'      => 'group_woodpro_header_layout',
		'title'    => __( 'Header', 'woodpro' ),
		'fields'   => [
			[
				'key'           => 'field_woodpro_header_layout',
				'name'          => 'header_layout',
				'label'         => __( 'Header layout', 'woodpro' ),
				'instructions'  => __( 'Desktop only. "Default" uses the site setting (Appearance › Customize › Header).', 'woodpro' ),
				'type'          => 'select',
				'choices'       => [
					''           => __( 'Default', 'woodpro' ),
					'horizontal' => __( 'Horizontal (logo left, menu right)', 'woodpro' ),
					'vertical'   => __( 'Vertical (logo, then menu)', 'woodpro' ),
				],
				'default_value' => '',
				'allow_null'    => 0,
				'return_format' => 'value',
			],
		],
		'location' => [
			[ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'page' ] ],
			[ [ 'param' => 'post_type', 'operator' => '==', 'value' => 'post' ] ],
		],
		'position' => 'side',
		'style'    => 'default',
	] );
} );

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
		'description' => __( 'Default for all pages (desktop only: mobile always shows logo + burger). A page can choose another one in its sidebar, "Header layout".', 'woodpro' ),
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
