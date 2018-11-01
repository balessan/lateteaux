<?php
namespace LTAV\ContentTypes;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Post Type
class TravelExperience {
	private static $instance;

	public static function getInstance() {
		if( null == self::$instance ) {
			self::$instance = new TravelExperience();
		}
		return self::$instance;
	}

	private function __construct() {
		  add_action( 'init', array( $this, 'add_travel_experience_post_type' ) );

    	include_once( plugin_dir_path( __FILE__ ) . '/../../advanced-custom-fields-pro/acf.php' );
    	add_action( 'init', array( $this, 'add_acf_fields') );
	}

    // Register Custom Post Type
    public function add_travel_experience_post_type() {
    	$labels = array(
    		'name'                  => _x( 'Expérience', 'Post Type General Name', 'ltav' ),
    		'singular_name'         => _x( 'Expérience', 'Post Type Singular Name', 'ltav' ),
    		'menu_name'             => __( 'Expériences', 'ltav' ),
    		'name_admin_bar'        => __( 'Expérience', 'ltav' ),
    		'archives'              => __( 'Item Archives', 'ltav' ),
    		'attributes'            => __( 'Item Attributes', 'ltav' ),
    		'parent_item_colon'     => __( 'Parent Item:', 'ltav' ),
    		'all_items'             => __( 'Toutes les expériences', 'ltav' ),
    		'add_new_item'          => __( 'Ajouter une expérience', 'ltav' ),
    		'add_new'               => __( 'Ajouter', 'ltav' ),
    		'new_item'              => __( 'Nouveau', 'ltav' ),
    		'edit_item'             => __( 'Éditer', 'ltav' ),
    		'update_item'           => __( 'Mettre à jour', 'ltav' ),
    		'view_item'             => __( 'Afficher', 'ltav' ),
    		'view_items'            => __( 'Afficher la expérience', 'ltav' ),
    		'search_items'          => __( 'Rechercher', 'ltav' ),
    		'not_found'             => __( 'Not found', 'ltav' ),
    		'not_found_in_trash'    => __( 'Not found in Trash', 'ltav' ),
    		'featured_image'        => __( 'Featured Image', 'ltav' ),
    		'set_featured_image'    => __( 'Set featured image', 'ltav' ),
    		'remove_featured_image' => __( 'Remove featured image', 'ltav' ),
    		'use_featured_image'    => __( 'Use as featured image', 'ltav' ),
    		'insert_into_item'      => __( 'Insert into item', 'ltav' ),
    		'uploaded_to_this_item' => __( 'Uploaded to this item', 'ltav' ),
    		'items_list'            => __( 'Liste des expériences', 'ltav' ),
    		'items_list_navigation' => __( 'Items list navigation', 'ltav' ),
    		'filter_items_list'     => __( 'Filter items list', 'ltav' ),
    	);

    	$args = array(
    		'label'                 => __( 'Expériences', 'ltav' ),
        'description'           => __( 'Gestion des expériences', 'ltav' ),
    		'labels'                => $labels,
    		'supports'              => array( 'title', 'thumbnail', 'editor' ),
    		'taxonomies'            => array( 'ltav_country', 'ltav_exp_category' ),
    		'hierarchical'          => false,
    		'public'                => true,
    		'show_ui'               => true,
    		'show_in_menu'          => true,
    		'menu_position'         => 5,
        'menu_icon'             => 'dashicons-visibility',
    		'show_in_admin_bar'     => true,
    		'show_in_nav_menus'     => true,
    		'can_export'            => true,
    		'has_archive'           => true,
    		'exclude_from_search'   => false,
    		'publicly_queryable'    => true,
    		'capability_type'       => 'post',
  			'rewrite' 				=> array(
  				'slug' => 'expériences',
  				'with_front' => false,
  			),
    	);

    	register_post_type( 'ltav_experience', $args );
    }

    public static function add_acf_fields() {
        if( function_exists('acf_add_local_field_group') ):
            acf_add_local_field_group(array (
                'key' => 'group_5a1ae0083d46d',
                'title' => 'Travel Experience Fields',
                'fields' => array (
                    array (
                        'key' => 'field_5a1ae01c4cff5',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'value' => NULL,
                        'instructions' => 'Sous-titre de longueur de 3 lignes maximum.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'maxlength' => '',
                        'rows' => 3,
                        'new_lines' => '',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'ltav_experience',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'acf_after_title',
                'style' => 'seamless',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
                'description' => '',
            ));

        endif;
    }
}
