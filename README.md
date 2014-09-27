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

## Changelog:

# Version 0.2
- First draft plugin version using procedural programming and a rather compilcated folder structure

# Version 1.0
- Rewrite the whole plugin to an object oriented version
- Dramatically simplify the folder and naming structure, enabling themes/plugins/core to share a textdomain