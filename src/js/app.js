/**
 * Woodpro front-end: hm-starter base (view transitions, Lenis, GSAP entrances, carousels,
 * read more) + the site's own modules. Form fields come from hm-core (loaded with forms).
 */
import 'hm-starter/js/app';
import '../scss/app.scss';

import { onReady } from 'hm-starter/js/modules/core';
import menu from './modules/menu';

onReady( () => {
	menu();
} );
