<?php
namespace CamilleAless\Taxonomies;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Setup class in charge of everything related to the taxonomies we are using on
 * CamilleAless
 */
class Setup {

  /**
   * bootstrap - The bootstrap method, instanciating all classes as a Singleton
   *
   * @return {type}  description
   */
  public static function bootstrap() {
    \CamilleAless\Utils::recursivelyIncludeDirectoryFiles( __DIR__, 'CamilleAless\Taxonomies' );
  }
}

?>
