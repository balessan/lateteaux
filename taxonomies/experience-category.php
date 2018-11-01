<?php
namespace LTAV\Taxonomies;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Post Type
class ExperienceCategory {
	private static $instance;

	public static function getInstance() {
		if( null == self::$instance ) {
			self::$instance = new ExperienceCategory();
		} // end if
		return self::$instance;
	}

	private function __construct() {
		add_action( 'init', array($this, 'add_experience_category_taxonomy') );
	}

	// Register Custom Taxonomy
	function add_experience_category_taxonomy() {
		$labels = array(
			'name'                       => _x( 'Catégories', 'Taxonomy General Name', 'ltav' ),
			'singular_name'              => _x( 'Catégorie', 'Taxonomy Singular Name', 'ltav' ),
			'menu_name'                  => __( 'Catégorie', 'ltav' ),
			'all_items'                  => __( 'Toutes les catégories', 'ltav' ),
			'parent_item'                => __( 'Parent Item', 'ltav' ),
			'parent_item_colon'          => __( 'Parent Item:', 'ltav' ),
			'new_item_name'              => __( 'Nouvelle catégorie', 'ltav' ),
			'add_new_item'               => __( 'Ajouter', 'ltav' ),
			'edit_item'                  => __( 'Éditer', 'ltav' ),
			'update_item'                => __( 'Mettre à jour', 'ltav' ),
			'view_item'                  => __( 'Afficher', 'ltav' ),
			'separate_items_with_commas' => __( 'Séparer les catégories avec des virgules', 'ltav' ),
			'add_or_remove_items'        => __( 'Ajouter ou supprimer une catégorie', 'ltav' ),
			'choose_from_most_used'      => __( 'Choisir parmi les plus utilisées', 'ltav' ),
			'popular_items'              => __( 'Catégories populaires', 'ltav' ),
			'search_items'               => __( 'Rechercher', 'ltav' ),
			'not_found'                  => __( 'Not Found', 'ltav' ),
			'no_terms'                   => __( 'No items', 'ltav' ),
			'items_list'                 => __( 'Items list', 'ltav' ),
			'items_list_navigation'      => __( 'Items list navigation', 'ltav' ),
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

		register_taxonomy( 'ltav_exp_category', array( 'ltav_experience' ), $args );
	}
}
