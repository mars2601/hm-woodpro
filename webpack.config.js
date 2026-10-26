/**
 * One bundle for the site: build/app.{js,css} = hm-starter sources + this theme.
 *
 * - `hm-starter/…` imports resolve to the parent theme's src/ folder.
 * - Packages resolve here first, then in the parent's node_modules (gsap, lenis, swiper),
 *   so each library is bundled once.
 * - The parent's SCSS is on the Sass load path: `@use "tools/media-queries"`.
 */
const path = require( 'path' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

const parent = path.resolve( __dirname, '../hm-starter' );

const withSassLoadPath = ( rule ) => {
	if ( ! rule.test || ! String( rule.test ).includes( 'sa' ) || ! rule.use ) {
		return rule;
	}
	return {
		...rule,
		use: rule.use.map( ( loader ) =>
			typeof loader === 'object' && String( loader.loader ).includes( 'sass-loader' )
				? {
						...loader,
						options: {
							...loader.options,
							sassOptions: { loadPaths: [ path.join( parent, 'src/scss' ) ] },
						},
				  }
				: loader
		),
	};
};

module.exports = {
	...defaultConfig,
	entry: { app: path.resolve( __dirname, 'src/js/app.js' ) },
	resolve: {
		...defaultConfig.resolve,
		alias: {
			...defaultConfig.resolve?.alias,
			'hm-starter': path.join( parent, 'src' ),
		},
		modules: [
			path.resolve( __dirname, 'node_modules' ),
			path.join( parent, 'node_modules' ),
			'node_modules',
		],
	},
	module: {
		...defaultConfig.module,
		rules: defaultConfig.module.rules.map( withSassLoadPath ),
	},
};
