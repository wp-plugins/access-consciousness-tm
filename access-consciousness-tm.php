<?php
/*
Plugin Name: Access Consciousness TM
Plugin URI: http://surniaulula.com/wordpress-plugins/access-consciousness-tm/
Author: Jean-Sebastien Morisset
Author URI: http://surniaulula.com/
Description: Searches for Access Consiousness(tm) trademarked terms and adds a TM suffix.
Version: 1.1

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

add_action( 'admin_init', 'ac_tm_requires' );
add_action( 'init', 'ac_tm_init' );

function ac_tm_init() {
	if ( ! is_admin() ) {
		add_filter( 'the_title', 'ac_tm_content' );
		add_filter( 'the_excerpt', 'ac_tm_content' );
		add_filter( 'the_content', 'ac_tm_content' );
		add_filter( 'link_name', 'ac_tm_link' );
		add_filter( 'link_description', 'ac_tm_link' );
	}
}

function ac_tm_requires() {
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

function ac_tm_content( $content ) { 
	return ac_tm_replace( '<span id="TM">TM</span>', $content );
}

// link_names cannot contain html tags, so use the ampersand code instead.
function ac_tm_link( $content ) { 
	return ac_tm_replace( '&trade;', $content );
}

function ac_tm_replace( $tm, $text ) {
	$pattern = array(
		# English
		'/(^|[^"\'])(Access Consciousness(<\/[aA]>)?)([^"\']|$)/',
		'/(^|[^"\'])((Access B|The B)[aA][rR][sS](<\/[aA]>)?)([^"\']|$)/',
		# French
		'/(^|[^"\'])(Barres d(\'|&#039;|&#8217;|&rsquo;)Accès(<\/[aA]>)?)([^"\']|$)/',
		'/(^|[^"\'])(Les Barres(<\/[aA]>)?)(([^"\']|$)?( [^d]))/',
	);
	$replace = array(
		'$1$2'.$tm.'$4',
		'$1${3}ars$4'.$tm.'$5',
		'$1$2'.$tm.'$5',
		'$1$2'.$tm.'$4',
	);
	ksort($pattern);
	ksort($replace);
	$text = preg_replace( $pattern, $replace, $text);
	return $text;
}

?>
