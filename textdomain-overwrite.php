<?php
/*
 * Plugin Name: Textdomain Overwrite
 * Description: Load custom localization files to overwrite core, plugin and theme strings
 * Version: 0.2
 * Author: Bernhard Kau
 * Author URI: http://kau-boys.de
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0
 */
 
function textdomain_overwrite_load(){
	$locale = get_locale();
	
	/* 
	 * overwriting string from the WordPress core
	 *
	 * The .mo file has to be named [locale].mo
	 * e.g. for the locale "de_DE" is has to be de_DE.mo
	 */
	 
	// if an overwrite file exists, load it for the core (default) textdomain
	$core_languagefile = WP_LANG_DIR . '/overwrites/core/' . $locale . '.mo';
	if ( file_exists ( $core_languagefile ) ) {
		load_textdomain( 'default', $core_languagefile );
	}
	
	/* 
	 * Overwriting strings from a theme
	 *
	 * The .mo file has to be named [locale].mo
	 * e.g. for the locale "de_DE" is has to be de_DE.mo
	 */
	 
	// get the current (parent) theme
	$template = get_template();
	
	// if an overwrite file exists, load it for the themes textdomain
	$template_languagefile = WP_LANG_DIR . '/overwrites/themes/' . $template . '/' . $locale . '.mo';
	if ( file_exists ( $core_languagefile ) ) {
		load_textdomain( $template, $template_languagefile );
	}
	
	/* 
	 * Overwriting strings from a child theme
	 *
	 * The .mo file has to be named [locale].mo
	 * e.g. for the locale "de_DE" is has to be de_DE.mo
	 */
	 
	// get the active theme
	$stylesheet = get_stylesheet();
	
	// check if active theme is a childtheme
	if ( $template != $stylesheet ) {
		// if an overwrite file exists, load it for the child themes textdomain
		$template_languagefile = WP_LANG_DIR . '/overwrites/themes/' . $stylesheet . '/' . $locale . '.mo';
		if ( file_exists ( $core_languagefile ) ) {
			load_textdomain( $stylesheet, $template_languagefile );
		}
	}
	
	/* 
	 * Overwriting strings from a plugin
	 *
	 * The .mo file has to be named [domain]-[locale].mo
	 * e.g. for the plugin Jetpack with the textdomain "jetpack"
	 * and the locale "de_DE" is has to be jetpack-de_DE.mo
	 */
	 
	// get all active plugins from the options
	$active_plugins = get_option( 'active_plugins', array() );
	
	// convert the array to a string, to be able to search within the active plugins for textdomains
	$active_plugins_string = implode( (array) $active_plugins );
	
	// get all overwrite files for plugins
	$plugin_languagefiles = glob( WP_LANG_DIR . '/overwrites/plugins/*.mo' );
	
	// if the overwrite file matches an active plugin, load it for the plugins textdomain
	foreach( $plugin_languagefiles as $plugin_languagefile ) {
		$plugin_basename = basename( $plugin_languagefile );
		if ( preg_match( '/(.*)-' . $locale . '\.mo/', $plugin_basename, $matches ) ) {
			$domain = $matches[1];
			if ( false !== strpos( $active_plugins_string, $domain ) ) {
				load_textdomain( $domain, $plugin_languagefile );
			}
		}
	}
}
add_action( 'plugins_loaded', 'textdomain_overwrite_load', 9 );
