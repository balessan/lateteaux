<?php
namespace LTAV\Admin;

// Exit if accessed Adminy
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Post Type
class FrontPage {
    private static $instance;

	public static $id;

    public static function getInstance() {
        if( null == self::$instance ) {
            self::$instance = new \LTAV\Admin\FrontPage();
        } // end if
        return self::$instance;
    }

    private function __construct() {
        include_once( plugin_dir_path( __FILE__ ) . '/../../advanced-custom-fields-pro/acf.php' );

        // Showing multiple post types in Posts Widget
        add_action('elementor_pro/posts/query/front_page_query_filter', array( $this, 'front_page_posts_query') );
    }



  public function front_page_posts_query( $query ) {
    // Here we set the query to fetch posts with
    // post type of 'custom-post-type1' and 'custom-post-type2'
    $query->set( 'post_type', [ 'ltav_gear', 'post', 'ltav_experience', 'ltav_step' ] );
  }

    //Add Events page on activation:
	public static function install_frontpage() {
		self::$id = \LTAV\Utils::install_new_page( 'accueil' );

        $front_page_settings = get_option('show_on_front');
        if ( $front_page_settings == 'posts' ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', self::$id );
        }
	}
}
