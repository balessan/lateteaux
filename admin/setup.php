<?php
namespace CamilleAless\Admin;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Setup class in charge of everything related to the custom post type we are using on
* CamilleAless
*/
class Setup {

	/**
	* bootstrap - The bootstrap method, instanciating all classes as a Singleton
	*
	* @return {type}  description
	*/
	public static function bootstrap() {
		\CamilleAless\Utils::recursivelyIncludeDirectoryFiles( __DIR__, 'CamilleAless\Admin' );
	}
}

?>
