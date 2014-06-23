<?php
/*
 * Plugin Name: Textdomain Overwrite
 * Description: Load custom localization files to overwrite core, plugin and theme strings
 * Version: 1.0
 * Author: Bernhard Kau
 * Author URI: http://kau-boys.de
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0
 */


/*
 * Overwriting strings from all loaded textdomains, no matter if they are used in Core, Plugins or Themes
 *
 * The .mo file has to be named [domain]-[locale].mo
 * e.g. for the plugin Jetpack with the textdomain "jetpack"
 * and the locale "de_DE" is has to be jetpack-de_DE.mo
 */
function textdomain_overwrite_load() {
	global $l10n;

	// get current locale
	$locale = get_locale();

	// get all loaded textdomains
	$loaded_textdomains = array_keys( $l10n );

	// if an overwrite file exists, load it to overwrite the original strings
	foreach ( $loaded_textdomains as $loaded_textdomain ) {
		$textdomain_filename = WP_LANG_DIR . '/overwrites/' . $loaded_textdomain . '-' . $locale . '.mo';

		if ( file_exists( $textdomain_filename ) ) {
			#load_textdomain( $loaded_textdomain, $textdomain_filename );
		}
	}
}

function override_textdomain( $override, $domain, $mofile ) {

	// get current locale
	$locale = get_locale();

	$textdomain_filename = WP_LANG_DIR . '/overwrites/' . $domain . '-' . $locale . '.mo';

	if ( file_exists( $textdomain_filename ) ) {
		load_textdomain( $domain, $textdomain_filename );
		return false;
	}
}

add_action( 'plugins_loaded', 'textdomain_overwrite_load' );
add_filter( 'override_load_textdomain', 'override_textdomain', 10, 3 );
