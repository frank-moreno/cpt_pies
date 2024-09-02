<?php

/**
 * Class for the plugin
 *
 * @package lawgistics_test
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit();

use StoutLogic\AcfBuilder\FieldsBuilder;

// require_once plugin_dir_path( __FILE__ ) . '../includes/lawgistics_test_loader.php';


//create a class for the plugin
class lawgistics_test {

    protected $version;

    public function __construct() {

        if ( defined( 'LT_VERSION' ) ) {
			$this->version = LT_VERSION;
		} else {
			$this->version = '1.0.0';
		}

        add_action( 'init', array( $this, 'register_pies_post_type' ) );
        add_action( 'acf/init', array( $this, 'register_pies_fields' ) );

        add_action( 'acf/init', array( $this, 'register_custom_options_page' ) );

        add_action( 'acf/init', array( $this, 'register_custom_options_fields' ) );

    }

    public function get_version() {
        return $this->version;
    }

    //https://github.com/StoutLogic/acf-builder/wiki
    public function register_pies_post_type() {
        $labels = array(
            'name'               => __( 'Pies', 'lawgistics_test' ),
            'singular_name'      => __( 'Pie', 'lawgistics_test' ),
            'menu_name'          => __( 'Pies', 'lawgistics_test' ),
            'name_admin_bar'     => __( 'Pie', 'lawgistics_test' ),
            'add_new'            => __( 'Add New', 'lawgistics_test' ),
            'add_new_item'       => __( 'Add New Pie', 'lawgistics_test' ),
            'new_item'           => __( 'New Pie', 'lawgistics_test' ),
            'edit_item'          => __( 'Edit Pie', 'lawgistics_test' ),
            'view_item'          => __( 'View Pie', 'lawgistics_test' ),
            'all_items'          => __( 'All Pies', 'lawgistics_test' ),
            'search_items'       => __( 'Search Pies', 'lawgistics_test' ),
            'parent_item_colon'  => __( 'Parent Pies:', 'lawgistics_test' ),
            'not_found'          => __( 'No pies found.', 'lawgistics_test' ),
            'not_found_in_trash' => __( 'No pies found in Trash.', 'lawgistics_test' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'pies' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );

        register_post_type( 'pies', $args );
    }

    public function register_pies_fields() {
        if ( function_exists('acf_add_local_field_group') ) {

            $piesFields = new FieldsBuilder('pies');

            $piesFields
                ->addText('pie_type', [
                    'label' => 'Pie Type',
                    'instructions' => 'Enter the type of pie.',
                    'required' => 1,
                ])
                ->addTextarea('description', [
                    'label' => 'Description',
                    'instructions' => 'Enter a description of the pie.',
                    'required' => 1,
                ])
                ->addRepeater('ingredients', [
                    'label' => 'Ingredients',
                    'instructions' => 'Add the ingredients of the pie.',
                    'min' => 1,
                    'layout' => 'table',
                    'button_label' => 'Add Ingredient',
                ])
                    ->addText('ingredient_name', [
                        'label' => 'Ingredient Name',
                        'required' => 1,
                    ])
                    ->addNumber('ingredient_quantity', [
                        'label' => 'Ingredient Quantity',
                        'required' => 1,
                    ])
                ->endRepeater();

            acf_add_local_field_group($piesFields->build());
            
        }

    }

    public function register_custom_options_page() {
        if ( function_exists('acf_add_options_page') ) {
            acf_add_options_page(array(
                'page_title'    => 'Custom Options',
                'menu_title'    => 'Custom Options',
                'menu_slug'     => 'custom-options',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ));
        }
    }

    public function register_custom_options_fields() {
        if ( function_exists('acf_add_local_field_group') ) {
            $options_builder = new FieldsBuilder('custom_options');

            $options_builder
                ->addTab('Pies Settings', ['placement' => 'left'])
                ->addRepeater('pies_settings', [
                    'layout' => 'block',
                    'label' => 'Pies Settings',
                    'button_label' => 'Add Pie Setting',
                ])
                    ->addText('setting_name', [
                        'label' => 'Setting Name',
                    ])
                    ->addText('setting_value', [
                        'label' => 'Setting Value',
                    ])
                ->endRepeater()
                ->setLocation('options_page', '==', 'acf-options-custom-options');

            acf_add_local_field_group($options_builder->build());
        }
    }

}