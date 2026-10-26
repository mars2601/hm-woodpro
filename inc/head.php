<?php
/**
 * <head> additions. TODO: favicon set (assets/images/favicon/).
 */

namespace Woodpro;

add_action( 'wp_head', function () {
	echo '<meta name="theme-color" content="#000000">' . "\n";
}, 5 );
