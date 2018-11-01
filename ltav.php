<?php
/*
Plugin Name: LTAV
Description: Plugin to properly setup the database with custom taxonomies and custom post types for our travel
Text Domain: ltav
Domain Path: /languages/
Version: 1.0
Author: Benoit Alessandroni
*/
namespace LTAV;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

require_once('ltav-utils.php');
require_once('content-types/setup.php');
require_once('taxonomies/setup.php');
require_once('admin/setup.php');

/**
* Main class of the plugin, in charge of setuping everything
*/
class LTAV {

	/**
	* Static instance of the class
	*/
	private static $instance;


	/**
	* get_instance - Method used to instanciate the class as a Singleton
	*
	* @return {LTAV}  The current instance if it exists, or the new one
	*/
	public static function get_instance() {
		if( null == self::$instance ) {
			self::$instance = new LTAV();
		} // end if
		return self::$instance;
	}

	private function __construct() {
		add_action('plugins_loaded', array( $this, 'load_plugin_textdomain') );

		ContentTypes\Setup::bootstrap();
		Taxonomies\Setup::bootstrap();
		Admin\Setup::bootstrap();

    register_activation_hook( __FILE__ , array( '\LTAV\Admin\FrontPage', 'install_frontpage' ) );
	}

	/**
	* load_plugin_textdomain - Method used to load the textdomain for handling translation
	*
	* @return {type}  description
	*/
	public function load_plugin_textdomain() {
		$path = basename( dirname( __FILE__ ) ) . '/languages/';
		load_plugin_textdomain('ltav', FALSE, $path);
	}
}

$LTAV = LTAV::get_instance();

?>
