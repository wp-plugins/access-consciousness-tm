<?php
/*
Plugin Name: Access Consciousness (R)
Plugin URI: http://surniaulula.com/wordpress-plugins/access-consciousness-tm/
Author: Jean-Sebastien Morisset
Author URI: http://surniaulula.com/
Description: Searches for Access Consciousness&reg; registered trademark terms and appends the &reg; suffix.
Version: 2.0

Copyright 2012 - Jean-Sebastien Morisset - http://surniaulula.com/

This script is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 3 of the License, or (at your option) any later
version.

This script is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU General Public License for more details at
http://www.gnu.org/licenses/.
*/

add_action( 'admin_init', 'acreg_requires' );
add_action( 'init', 'acreg_init' );

function acreg_init() {
	if ( ! is_admin() ) {
		add_filter( 'the_title', 'acreg_html' );
		add_filter( 'the_excerpt', 'acreg_html' );
		add_filter( 'the_content', 'acreg_html' );
		add_filter( 'link_name', 'acreg_text' );
		add_filter( 'link_description', 'acreg_text' );
	}
}

function acreg_requires() {
	global $wp_version;
	$plugin = plugin_basename( __FILE__ );
	$plugin_data = get_plugin_data( __FILE__, false );
	if ( version_compare($wp_version, "3.0", "<" ) ) {
		if( is_plugin_active($plugin) ) {
			deactivate_plugins( $plugin );
			wp_die( '"'.$plugin_data['Name'].'" requires WordPress 3.0 or higher and has been deactivated. Please upgrade WordPress and try again.<br /><br />Back to <a href="'.admin_url().'">WordPress admin</a>.' );
		}
	}
}

function acreg_html( $text ) { 
	return acreg_replace( '<span class="acreg">&reg</span>', $text );
}

function acreg_text( $text ) { 
	return acreg_replace( '&reg;', $text );
}

function acreg_replace( $char, $text ) {
	$pattern = array(
		# English
		'/(^|[^"\'])(Access Consciousness(<\/[aA]>)?)([^"\']|$)/',
		'/(^|[^"\'])((Access B|The B)[aA][rR][sS](<\/[aA]>)?)([^"\']|$)/',
		# French
		'/(^|[^"\'])(Barres d(\'|\’|&#039;|&#8217;|&rsquo;)[Aa]ccès(<\/[aA]>)?)([^"\']|$)/',
		'/(^|[^"\'])(Les Barres(<\/[aA]>)?)(([^"\']|$)?( [^d]))/',
	);
	$replace = array(
		'$1$2'.$char.'$4',
		'$1${3}ars$4'.$char.'$5',
		'$1$2'.$char.'$5',
		'$1$2'.$char.'$4',
	);
	ksort($pattern);
	ksort($replace);
	$text = preg_replace( $pattern, $replace, $text);
	return $text;
}

?>
