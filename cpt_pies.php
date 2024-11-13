<?php

/**
 * 
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           cpt_pies
 * 
 * 
 * Plugin Name: CPT Pies
 * Description: <code><strong>CPT Pies</strong></code>  is a technical challenge for Wordpress Developer
 * Plugin URI: https://github.com/frank-moreno/cpt_pies
 * Author: Francisco Moreno Carracedo
 * Author URI: https://frank-Moreno.com/
 * Version: 1.0.0
 * Text Domain: cpt_pies
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
require plugin_dir_path( __FILE__ ) . 'includes/class_cpt_pies.php';


// begins execution of the plugin
function run_cpt_pies() {

	$plugin = new class_cpt_pies();
	// $plugin->run();

}
// run_cpt_pies();
add_action('plugins_loaded', 'run_cpt_pies');