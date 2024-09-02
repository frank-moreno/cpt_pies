<?php

/**
 * Class for the plugin
 *
 * @package lawgistics_test
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit();

// require_once plugin_dir_path( __FILE__ ) . '../includes/lawgistics_test_Loader.php';


//create a class for the plugin
class lawgistics_test {

    protected $version;

    public function __construct() {

        if ( defined( 'LT_VERSION' ) ) {
			$this->version = LT_VERSION;
		} else {
			$this->version = '1.0.0';
		}

    }

    public function get_version() {
        return $this->version;
    }


}