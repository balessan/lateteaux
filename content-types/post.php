<?php
namespace LTAV\ContentTypes;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Post Type
class Post {
	private static $instance;

	public static function getInstance() {
		if( null == self::$instance ) {
			self::$instance = new Post();
		}
		return self::$instance;
	}

	private function __construct() {
	}
}
