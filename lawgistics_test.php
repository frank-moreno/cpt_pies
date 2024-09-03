<?php

/**
 * 
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           lawgistics_test
 * 
 * 
 * Plugin Name: Lawgistics Test
 * Description: <code><strong>Lawgistics Test</strong></code>  is a technical test for Wordpress Developer
 * Plugin URI: https://github.com/frank-moreno/lawgistics_test
 * Author: Francisco Moreno Carracedo
 * Author URI: https://frank-Moreno.com/
 * Version: 1.0.0
 * Text Domain: lawgistic_test
 * License: Apache 2.0
 * License URI: http://www.apache.org/licenses/
 * WP requires at least: 5.0.0
 * WP tested up to: 6.6.x
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Cargar el autoload de Composer
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Currently plugin version.
 */
define( 'LT_VERSION', '1.0.0' );


/**
 * The core plugin class
 */
require plugin_dir_path( __FILE__ ) . 'includes/class_lawgistics_test.php';


// begins execution of the plugin
function run_lawgistics_test() {

	$plugin = new class_lawgistics_test();
	// $plugin->run();

}
// run_lawgistics_test();
add_action('plugins_loaded', 'run_lawgistics_test');