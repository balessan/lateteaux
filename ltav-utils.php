<?php
namespace LTAV;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'Utils' ) ) {

	/**
	* The purpose of this class is to regroup all the utilities we will implement during the project, as static method of the class itself
	*/
	class Utils {

		/**
		 * Creates a new WordPress page and setup it as needed.
		 * @param  [type] $page_name     New page name.
		 * @param  [type] $page_template This new page custom template.
		 */
		public static function install_new_page( $page_name, $page_template = null )
		{
			$new_page_id = null;
			$page_check = get_page_by_title( $page_name );

			if ( empty( $page_check ) || ! isset( $page_check->ID ) ) {
				$new_page = array(
						'post_type' => 'page',
						'post_title' => $page_name,
						'post_content' => '',
						'post_status' => 'publish',
						'post_author' => 1
				);

				$new_page_id = wp_insert_post( $new_page );

				if( !empty( $page_template ) ) {
					update_post_meta( $new_page_id, '_wp_page_template', $page_template );
				}
			} else {
				$new_page_id = $page_check->ID;
			}

			return $new_page_id;
		}

		/**
		* recursivelyIncludeDirectoryFiles - Utility method to include all files from a directory recursively using an helper method
		*
		* @param  {type} $path description
		* @return {type}       description
		*/
		public static function recursivelyIncludeDirectoryFiles( $path, $namespace ) {
			$directory = new \RecursiveDirectoryIterator( $path );
			$recIterator = new \RecursiveIteratorIterator( $directory );
			$regex = new \RegexIterator( $recIterator, '/(?![setup.php])(.*.php)$/' );

			foreach( $regex as $item ) {
				$path_name = $item->getPathname();
				$file_name = $item->getFilename();
				if ( strpos( $path_name, 'setup.php' ) == false ) {
					require_once $path_name;
					$split_name = explode('.', $file_name);
					$class_name = '';
					if ( strpos( $split_name[0], '-') ) {
						$second_split = explode( '-', $split_name[0] );
						$second_split[1] = ucfirst( $second_split[1] );
						$class_name = implode( '', $second_split );
					} else {
						$class_name = ucfirst($split_name[0]);
					}
					$class_name = '\\' . $namespace . '\\' . $class_name;
					${$class_name} = $class_name::getInstance();
				}
			}
		}
	}
}
