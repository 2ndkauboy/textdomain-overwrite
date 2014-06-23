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
function textdomain_overwrite_load( $override, $domain, $mofile ) {

	$overwrite_folder = WP_LANG_DIR . '/overwrites/';

	// get current locale
	$locale = get_locale();

	// if the filter was not called with an overwrite mofile, return false which will procede with the mofile given and prevents an endless recursion
	if ( strpos( $mofile, $overwrite_folder ) !== false ) {
		return false;
	}

	// if an overwrite file exists, load it to overwrite the original strings
	$overwrite_mofile = $overwrite_folder . $domain . '-' . $locale . '.mo';

	if ( file_exists( $overwrite_mofile ) ) {
		load_textdomain( $domain, $overwrite_mofile );
	}

	return false;
}
add_action( 'override_load_textdomain', 'textdomain_overwrite_load', 10, 3 );
