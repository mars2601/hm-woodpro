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
	$config['dropdown_icon'] = 'carret-down'; // ⌄ on "Services", "Votre projet"… (hm-core menus)
	$config['dropdown_open'] = 'hover';       // open dropdowns on hover (click still works, touch screens click)
	$config['dropdown_morph'] = true;         // one box slides between Services / Mobilier / Entreprise
	return $config;
} );

/**
 * Page colour theme (body class `theme-{name}`). One for the whole site to start with.
 */
add_filter( 'hm_starter/page_theme', fn() => 'default' );

/**
 * Storybook (hm-core): theme parts rendered by `npm run storybook:fixtures`
 * (site-header and site-footer are included by default). Stories: src/stories/.
 */
add_filter( 'hm/storybook/parts', fn( array $parts ): array => $parts );
