<?php
namespace LTAV\Admin;

// Exit if accessed Adminy
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Post Type
class AcfFieldsConfig {
	private static $instance;

	public static function getInstance() {
		if( null == self::$instance ) {
			self::$instance = new AcfFieldsConfig();
		} // end if
		return self::$instance;
	}

	private function __construct() {
		add_filter('acf/fields/google_map/api', array( $this, 'set_google_map_api_key' ) );
	}

	public function set_google_map_api_key( $api ){
		$api[ 'key' ] = 'AIzaSyAFmOPob6eIU-pl5fKWYrm0rEUTsFQy6CA';
		return $api;
	}
}
