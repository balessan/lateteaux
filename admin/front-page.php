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

        // add_action( 'init', array( $this, 'add_acf_fields' ) );
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

    public function add_acf_fields() {
        self::$id = get_page_by_path( 'accueil' )->ID;

        if ( function_exists('acf_add_local_field_group') ):
            acf_add_local_field_group(array (
                'key' => 'group_5a09d47c269df',
                'title' => 'Front Page fields',
                'fields' => array (
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'page',
                            'operator' => '==',
                            'value' => self::$id,
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'seamless',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
				        'hide_on_screen' => array (
                    0 => 'the_content',
                ),
                'active' => 1,
                'description' => '',
            ));

        endif;
    }
}
