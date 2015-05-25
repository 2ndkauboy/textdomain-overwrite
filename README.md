textdomain-overwrite
====================

A simple plugin which enables a user to overwrite localization string from the WordPress core, 
plugins and themes, using it's own language files


## Usage

Just create a subfolder named `overwrites` in the `WP_LANG_DIR` folder (most probably /wp-content/languages).
The plugin does not distinguish if a mofile is used by a plugin, theme or even the core. ~Just name it after
the textdomain, followed by the locale, separated with a dash. This is how your folder structure might look like,
if you overwrite the core, the jetpack plugin and the twentythirteen theme for the locale `de_DE`:

```
wp-content
├── languages
│   └── overwrites
│       ├── default-de_DE.mo
│       ├── jetpack-de_DE.mo
│       ├── twentythirteen-de_DE.mo

```

All files must be prepended with the name of the textdomain. The textdomain for the core is `default`.

It is not recommended to use the functionality of this plugin to overwrite a complete language file by simply copy pasting it to forementioned folder structure. Instead it is suggested to create a new .po-file for the desired textdomain containing only the strings and their translations that would differ from the original translation file.
Schematic example:

original po file
string   ->    translation

your new po file
string   ->    your custom translation

For the exact lineup of the .po-file please open the original .po in a txt editor. Then create a new textfile and copy the string markups matching the strings you want to translate differently over into that new textfile. When done, save it like so: textdomain-de_DE.po (your locale)
Generate a .mo-File with PoEdit.

Please also see this Blogpost for background info (in german language):
http://kau-boys.de/1498/wordpress/wordpress-core-strings-ohne-verlust-beim-naechsten-update-ueberschreiben

## Changelog:

# Version 0.2
- First draft plugin version using procedural programming and a rather compilcated folder structure

# Version 1.0
- Rewrite the whole plugin to an object oriented version
- Dramatically simplify the folder and naming structure, enabling themes/plugins/core to share a textdomain
