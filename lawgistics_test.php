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
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /i18n
 * WP requires at least: 5.0.0
 * WP tested up to: 6.6.x
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'LT_VERSION', '1.0.0' );


/**
 * The code that runs during plugin activation.
 * This action comes from includes/lawgistics_test-activator.php
 */
function lawgistics_test_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/lawgistics_test-activator.php';
	lawgistics_test_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action comes from includes/lawgistics_test-deactivator.php
 */
function lawgistics_test_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/lawgistics_test-deactivator.php';
	lawgistics_test_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'lawgistics_test_activate' );
register_deactivation_hook( __FILE__, 'lawgistics_test_deactivate' );

/**
 * The core plugin class
 */
require plugin_dir_path( __FILE__ ) . 'includes/lawgistics_test.php';


// begins execution of the plugin
function run_lawgistics_test() {

	$plugin = new lawgistics_test();
	// $plugin->run();

}
run_lawgistics_test();