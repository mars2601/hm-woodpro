/**
 * wp-scripts rules. `hm-starter/…` (webpack alias) and the parent's packages (gsap, lenis, swiper)
 * resolve through webpack.config.js, not Node's resolver.
 */
module.exports = {
	root: true,
	extends: [ 'plugin:@wordpress/eslint-plugin/recommended' ],
	rules: {
		'import/no-unresolved': [ 'error', { ignore: [ '^hm-starter/', '^gsap', '^lenis', '^swiper' ] } ],
	},
};
