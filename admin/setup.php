<?php
namespace LTAV\Admin;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Setup class in charge of everything related to the custom post type we are using on
* LTAV
*/
class Setup {

	/**
	* bootstrap - The bootstrap method, instanciating all classes as a Singleton
	*
	* @return {type}  description
	*/
	public static function bootstrap() {
		\LTAV\Utils::recursivelyIncludeDirectoryFiles( __DIR__, 'LTAV\Admin' );
	}
}

?>
