textdomain-overwrite
====================

A simple plugin which enables a user to overwrite localization string from the WordPress core, 
plugins and themes, using it's own language files


## Usage

Just create some subfolder in the `WP_LANG_DIR` folder (most probably /wp-content/languages). 
This is how your folder structure might look like, if you overwrite the core, the jetpack plugin 
and the twentythirteen theme for the locale de_DE:

```
wp-content
├── languages
│   └── overwrites
│       ├── core
│       │   └── core
│       ├── plugins
│       │   └── jetpack-de_DE.mo
│       └── themes
│           └── twentythirteen
│               └── de_DE.mo
```

The overwrite files for the core and the themes should only be named with the locale, the files for 
plugins must be prepended with the name of the textdomain.
