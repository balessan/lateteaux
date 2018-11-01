<?php
/*
Plugin Name: Camille-Alessandroni
Description: Plugin to properly setup the database with custom taxonomies and custom post types for my sister purpose
Text Domain: camille-aless
Domain Path: /languages/
Version: 1.0
Author: Benoit Alessandroni
*/
namespace CamilleAless;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

require_once('ca-utils.php');
require_once('content-types/setup.php');
require_once('taxonomies/setup.php');
require_once('admin/setup.php');

/**
* Main class of the plugin, in charge of setuping everything
*/
class CamilleAless {

	/**
	* Static instance of the class
	*/
	private static $instance;


	/**
	* get_instance - Method used to instanciate the class as a Singleton
	*
	* @return {CamilleAless}  The current instance if it exists, or the new one
	*/
	public static function get_instance() {
		if( null == self::$instance ) {
			self::$instance = new CamilleAless();
		} // end if
		return self::$instance;
	}

	private function __construct() {
		add_action('plugins_loaded', array( $this, 'load_plugin_textdomain') );

		ContentTypes\Setup::bootstrap();
		Taxonomies\Setup::bootstrap();
		Admin\Setup::bootstrap();

        register_activation_hook( __FILE__ , array( '\CamilleAless\Admin\FrontPage', 'install_frontpage' ) );
	}

	/**
	* load_plugin_textdomain - Method used to load the textdomain for handling translation
	*
	* @return {type}  description
	*/
	public function load_plugin_textdomain() {
		$path = basename( dirname( __FILE__ ) ) . '/languages/';
		load_plugin_textdomain('camille-aless', FALSE, $path);
	}
}

$CamilleAless = CamilleAless::get_instance();

?>
