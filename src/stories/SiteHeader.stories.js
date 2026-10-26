/**
 * Site header (parts/site-header.php), rendered by WordPress (`npm run storybook:fixtures` in
 * hm-core with WP_HOST=woodpro.wp.local) and run with the theme's menu.js.
 */
import { Part } from '@hm-core/stories/Part';
import menu from '../js/modules/menu';

const mobile = { viewport: { value: 'mobile2', isRotated: false } };

export default {
	title: 'Site/Header',
	parameters: { layout: 'fullscreen' },
	args: { pageTheme: 'default' },
	argTypes: {
		pageTheme: { control: 'inline-radio', options: [ 'default', 'dark' ], description: 'Page colour theme (body class theme-*)' },
	},
};

export const Desktop = {
	render: ( { pageTheme } ) => <Part slug="site-header" pageTheme={ pageTheme } setup={ ( root ) => menu( root ) } />,
};

export const Mobile = {
	globals: mobile,
	render: ( { pageTheme } ) => <Part slug="site-header" pageTheme={ pageTheme } setup={ ( root ) => menu( root ) } />,
};

export const MobileMenuOpen = {
	name: 'Mobile, menu open',
	globals: mobile,
	render: ( { pageTheme } ) => (
		<Part
			slug="site-header"
			pageTheme={ pageTheme }
			setup={ ( root ) => {
				menu( root );
				root.querySelector( '.site-header__burger' )?.click();
			} }
		/>
	),
};
