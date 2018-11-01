<?php
namespace CamilleAless\ContentTypes;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Post Type
class Portfolio {
	private static $instance;

	public static function getInstance() {
		if( null == self::$instance ) {
			self::$instance = new Portfolio();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action( 'init', array( $this, 'add_portfolio_post_type' ) );

    	include_once( plugin_dir_path( __FILE__ ) . '/../../advanced-custom-fields-pro/acf.php' );
    	add_action( 'init', array( $this, 'add_acf_fields') );
	}

    // Register Custom Post Type
    public function add_portfolio_post_type() {
    	$labels = array(
    		'name'                  => _x( 'Illustrations', 'Post Type General Name', 'camille-aless' ),
    		'singular_name'         => _x( 'Illustration', 'Post Type Singular Name', 'camille-aless' ),
    		'menu_name'             => __( 'Illustrations', 'camille-aless' ),
    		'name_admin_bar'        => __( 'Illustration', 'camille-aless' ),
    		'archives'              => __( 'Item Archives', 'camille-aless' ),
    		'attributes'            => __( 'Item Attributes', 'camille-aless' ),
    		'parent_item_colon'     => __( 'Parent Item:', 'camille-aless' ),
    		'all_items'             => __( 'Toutes les illustrations', 'camille-aless' ),
    		'add_new_item'          => __( 'Ajouter une illustration', 'camille-aless' ),
    		'add_new'               => __( 'Ajouter', 'camille-aless' ),
    		'new_item'              => __( 'Nouveau', 'camille-aless' ),
    		'edit_item'             => __( 'Éditer', 'camille-aless' ),
    		'update_item'           => __( 'Mettre à jour', 'camille-aless' ),
    		'view_item'             => __( 'Afficher', 'camille-aless' ),
    		'view_items'            => __( 'Afficher les illustrations', 'camille-aless' ),
    		'search_items'          => __( 'Rechercher', 'camille-aless' ),
    		'not_found'             => __( 'Not found', 'camille-aless' ),
    		'not_found_in_trash'    => __( 'Not found in Trash', 'camille-aless' ),
    		'featured_image'        => __( 'Featured Image', 'camille-aless' ),
    		'set_featured_image'    => __( 'Set featured image', 'camille-aless' ),
    		'remove_featured_image' => __( 'Remove featured image', 'camille-aless' ),
    		'use_featured_image'    => __( 'Use as featured image', 'camille-aless' ),
    		'insert_into_item'      => __( 'Insert into item', 'camille-aless' ),
    		'uploaded_to_this_item' => __( 'Uploaded to this item', 'camille-aless' ),
    		'items_list'            => __( 'Liste des illustrations', 'camille-aless' ),
    		'items_list_navigation' => __( 'Items list navigation', 'camille-aless' ),
    		'filter_items_list'     => __( 'Filter items list', 'camille-aless' ),
    	);

    	$args = array(
    		'label'                 => __( 'Illustration', 'camille-aless' ),
    		'description'           => __( 'Gestion des illustrations', 'camille-aless' ),
    		'labels'                => $labels,
    		'supports'              => array( 'title', 'thumbnail' ),
    		'taxonomies'            => array( 'ca_category' ),
    		'hierarchical'          => false,
    		'public'                => true,
    		'show_ui'               => true,
    		'show_in_menu'          => true,
    		'menu_position'         => 5,
            'menu_icon'             => 'dashicons-format-image',
    		'show_in_admin_bar'     => true,
    		'show_in_nav_menus'     => true,
    		'can_export'            => true,
    		'has_archive'           => true,
    		'exclude_from_search'   => false,
    		'publicly_queryable'    => true,
    		'capability_type'       => 'post',
			'rewrite' 				=> array(
				'slug' => 'illustrations',
				'with_front' => false,
			),
    	);

    	register_post_type( 'ca_illustration', $args );
    }

    public static function add_acf_fields() {
        if( function_exists('acf_add_local_field_group') ):
            acf_add_local_field_group(array (
                'key' => 'group_5a1ae0083d46d',
                'title' => 'Basket Fields',
                'fields' => array (
                    array (
                        'key' => 'field_5a1ae01c4cff3',
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
                            'value' => 'ca_illustration',
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
