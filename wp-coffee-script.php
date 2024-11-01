<?php
/**
Plugin name: WP CoffeeScript
Plugin URI: http://wordpress.org/plugins/wp-coffee-script/
Description: With Wordpress CoffeeScript you can easy use CoffeeScript in WP themes and plugins. Just add "enqueue_coffee($url, $ver);" to functions.php to require your JS files with coffee syntax.
Version: 1.0
Author: Nick Yurov
Author URI: http://nickyurov.com
*/
global $coffee_scripts;
$coffee_scripts = array();

function enqueue_coffee($src, $ver=false) {
	global $coffee_scripts;
	$coffee_scripts[] = array($src, $ver);
}

add_action('wp_head', 'add_coffee_scripts');
function add_coffee_scripts(){
	global $coffee_scripts;
	foreach($coffee_scripts as $script){
		$url = $script[0];
		if (empty($url))
			break;
			
		$ver = $script[1];
		if (empty($ver))
			$ver = '1';
			
		echo '<script type="text/coffeescript" src="' . $url . '?ver=' . $ver . '"></script>';
	}
}

function add_coffee_compiler() {
    wp_enqueue_script('coffee-script', plugin_dir_url(__FILE__) . '/js/coffee-script.js', false, '1.6.3', true);
}
add_action('wp_enqueue_scripts', 'add_coffee_compiler');

//enqueue_coffee('url', 5);