/**
 * Mobile menu: the burger opens/closes the primary navigation (.site-header.is-open).
 * Escape and a click on a link close it.
 */
export default function menu( root = document ) {
	const header = root.querySelector( '.site-header' );
	const burger = header?.querySelector( '.site-header__burger' );
	if ( ! burger ) {
		return;
	}
	const set = ( open ) => {
		header.classList.toggle( 'is-open', open );
		burger.setAttribute( 'aria-expanded', String( open ) );
		document.documentElement.classList.toggle( 'has-menu-open', open );
	};
	burger.addEventListener( 'click', () => set( ! header.classList.contains( 'is-open' ) ) );
	header.querySelectorAll( '.site-nav a' ).forEach( ( a ) => a.addEventListener( 'click', () => set( false ) ) );
	document.addEventListener( 'keydown', ( e ) => e.key === 'Escape' && set( false ) );
}
