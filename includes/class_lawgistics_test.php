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
class class_lawgistics_test {

    protected $version;

    public function __construct() {

        if ( defined( 'LT_VERSION' ) ) {
			$this->version = LT_VERSION;
		} else {
			$this->version = '1.0.0';
		}

        add_action( 'init', array( $this, 'register_pies_post_type' ) );
        add_action( 'acf/init', array( $this, 'register_pies_fields' ) );
        add_action( 'init', array( $this, 'register_shortcodes' ) );

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
    
            // Manual array works better here
            $fields = array(
                'key' => 'group_pies',
                'title' => 'Pies',
                'fields' => array(
                    array(
                        'key' => 'field_pie_type',
                        'label' => 'Pie Type',
                        'name' => 'pie_type',
                        'type' => 'text',
                        'instructions' => 'Enter the type of pie.',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => 'Enter a description of the pie.',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_ingredients',
                        'label' => 'Ingredients',
                        'name' => 'ingredients',
                        'type' => 'repeater',
                        'instructions' => 'Add the ingredients of the pie.',
                        'min' => 1,
                        'layout' => 'table',
                        'button_label' => 'Add Ingredient',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_ingredient_name',
                                'label' => 'Ingredient Name',
                                'name' => 'ingredient_name',
                                'type' => 'text',
                                'required' => 1,
                            ),
                            array(
                                'key' => 'field_ingredient_quantity',
                                'label' => 'Ingredient Quantity',
                                'name' => 'ingredient_quantity',
                                'type' => 'number',
                                'required' => 1,
                            ),
                        ),
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'pies',
                        ),
                    ),
                ),
            );
    
            acf_add_local_field_group($fields);
        } else {
            error_log('acf_add_local_field_group does not exist');
        }
    }

    //SHORTCODE
    public function register_shortcodes() {
        add_shortcode( 'pies', array( $this, 'render_shortcode_pie' ) );
    }

    public function render_shortcode_pie($atts) {
        // Attr by default
        $atts = shortcode_atts(
            array(
                'lookup' => '',         
                'ingredients' => '',    // Ingredients list separated by coma
                'posts_per_page' => 3,
            ), 
            $atts, 
            'pies'
        );
    
        // Get current page
        $paged = isset($_GET['paged']) ? absint($_GET['paged']) : 1;
    
        // Args for WP_Query
        $args = array(
            'post_type'              => array( 'pies' ),
            'post_status'            => array( 'publish' ),
            'posts_per_page'         => $atts['posts_per_page'],
            'paged'                  => $paged,
            'order'                  => 'ASC',
        );
    
        $meta_query = array('relation' => 'AND');
    
        if (!empty($atts['lookup'])) {
            $meta_query[] = array(
                'key'     => 'pie_type',
                'value'   => $atts['lookup'],
                'compare' => 'LIKE',
            );
        }
    
        if (!empty($atts['ingredients'])) {
            $ingredients_list = explode(',', $atts['ingredients']);
    
            foreach ($ingredients_list as $ingredient) {
                $meta_query[] = array(
                    'key'     => 'ingredients',
                    'value'   => trim($ingredient),
                    'compare' => 'LIKE',
                );
            }
        }
    
        if (count($meta_query) > 1) {
            $args['meta_query'] = $meta_query;
        }
    
        // The query
        $query = new WP_Query( $args );
    
        // The Loop
        if ( $query->have_posts() ) {
            $output = '';
    
            while ( $query->have_posts() ) {
                $query->the_post();
    
                $pie_type = get_field('pie_type');
                $description = get_field('description');
                $ingredients = get_field('ingredients');
    
                $ingredients_list_html = '<ul>';
                if (!empty($ingredients)) {
                    foreach ($ingredients as $ingredient) {
                        $ingredients_list_html .= '<li>' . esc_html($ingredient['ingredient_name']) . ': ' . esc_html($ingredient['ingredient_quantity']) . '</li>';
                    }
                }
                $ingredients_list_html .= '</ul>';
    
                // HTML output
                $output .= '<div class="card">
                                <div class="card-body">
                                    <div class="project-item__content">
                                        <h3 class="project-item__title">' . get_the_title() . '</h3>
                                        <div class="project-item__meta">
                                            <strong>Pie Type:</strong> ' . esc_html($pie_type) . '<br>
                                            <strong>Description:</strong> ' . esc_html($description) . '<br>
                                            <strong>Ingredients:</strong> ' . $ingredients_list_html . '
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
    
            // Adding pagination
            $pagination = paginate_links( array(
                'base'      => add_query_arg('paged', '%#%'),
                'format'  => '?paged=%#%',
                'current' => max(1, $paged),
                'total'   => $query->max_num_pages,
                'prev_text' => __('« Prev'),
                'next_text' => __('Next »'),
                'type'    => 'list',
            ) );
    
            $output .= '<div class="pagination">' . $pagination . '</div>';
        
        } else {
            $output = '<p>No pies found.</p>';
        }
    
        // Restore original Post Data
        wp_reset_postdata();
    
        return $output;
    }

}