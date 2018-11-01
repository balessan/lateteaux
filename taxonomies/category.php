<?php
namespace CamilleAless\Taxonomies;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Post Type
class Category {
	private static $instance;

	public static function getInstance() {
		if( null == self::$instance ) {
			self::$instance = new Category();
		} // end if
		return self::$instance;
	}

	private function __construct() {
		add_action( 'init', array($this, 'add_category_taxonomy') );
	}

	// Register Custom Taxonomy
	function add_category_taxonomy() {
		$labels = array(
			'name'                       => _x( 'Catégories', 'Taxonomy General Name', 'camille-aless' ),
			'singular_name'              => _x( 'Catégorie', 'Taxonomy Singular Name', 'camille-aless' ),
			'menu_name'                  => __( 'Catégorie', 'camille-aless' ),
			'all_items'                  => __( 'Toutes les catégories', 'camille-aless' ),
			'parent_item'                => __( 'Parent Item', 'camille-aless' ),
			'parent_item_colon'          => __( 'Parent Item:', 'camille-aless' ),
			'new_item_name'              => __( 'Nouvelle catégorie', 'camille-aless' ),
			'add_new_item'               => __( 'Ajouter', 'camille-aless' ),
			'edit_item'                  => __( 'Éditer', 'camille-aless' ),
			'update_item'                => __( 'Mettre à jour', 'camille-aless' ),
			'view_item'                  => __( 'Afficher', 'camille-aless' ),
			'separate_items_with_commas' => __( 'Séparer les catégories avec des virgules', 'camille-aless' ),
			'add_or_remove_items'        => __( 'Ajouter ou supprimer une catégorie', 'camille-aless' ),
			'choose_from_most_used'      => __( 'Choisir parmi les plus utilisées', 'camille-aless' ),
			'popular_items'              => __( 'Catégories populaires', 'camille-aless' ),
			'search_items'               => __( 'Rechercher', 'camille-aless' ),
			'not_found'                  => __( 'Not Found', 'camille-aless' ),
			'no_terms'                   => __( 'No items', 'camille-aless' ),
			'items_list'                 => __( 'Items list', 'camille-aless' ),
			'items_list_navigation'      => __( 'Items list navigation', 'camille-aless' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);

		register_taxonomy( 'ca_category', array( 'ca_illustration' ), $args );
	}
}
