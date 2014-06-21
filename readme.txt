=== Access Consciousness (R) ===
Contributors: jsmoriss
Tags: access conciousness, trademark, suffix
License: GPLv2 or later
Requires at least: 3.0
Tested up to: 3.9.1
Stable tag: 2.0

Searches for Access Consciousness&reg; registered trademark terms and appends the &reg; suffix.

== Description ==

This plugin searches content, excerpt, titles, link names, and link descriptions for Access Consciousness&reg; registered trademark terms (French and English) and appends the &reg; suffix. The suffix is wrapped within an HTML span tag with a class name of "acreg". As an example, you can use the following CSS to position and size the suffix text.

`
.acreg {
        vertical-align:top;
        font-weight:normal;
        font-size:0.8em;
}
h1 .acreg, h2 .acreg, h3 .acreg, h4 .acreg {
        font-weight:normal;
        font-size:0.7em;
}
`

== Installation ==

*Using the WordPress Dashboard*

1. Login to your weblog
1. Go to Plugins
1. Select Add New
1. Search for *Access Consciousness*
1. Select Install
1. Select Install Now
1. Select Activate Plugin

*Manual*

1. Download and unzip the plugin
1. Upload the entire `access-consciousness-tm/` folder to the `wp-content/plugins/` directory
1. Activate the plugin through the Plugins menu in WordPress

== Frequently Asked Questions ==

== Changelog ==

= v2.0 =

* Changed the &trade; trademark HTML entity for the &reg; registered trademark.
* **Renamed the CSS id name of "TM" to a class name of "acreg".**

= v1.1 =

* Changed add_action to add_filter.
* Added a filter for the_excerpt as well.

= v1.0 =

* Initial release.

