<?php
namespace CamilleAless\ContentTypes;

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
      // add_action( 'save_post', array( $this, 'auto_set_featured') );

      add_action( 'admin_init', array( $this, 'generate_featured_image_as_bulk'));
	}

  public function auto_set_featured( $post = NULL ) {
    // retrieve post object
    $post = get_post( $post );
    // var_dump( !($post instanceof \WP_Post));
    // nothing to do if no post, or post already has thumbnail
    if ( !($post instanceof \WP_Post))
       return;
    // prepare $thumbnail var
    $thumbnail = NULL;
    // retrieve all the images uploaded to the post
    $images = get_posts( array(
      'post_parent'    => $post->ID,
      'post_type'      => 'attachment',
      'post_mime_type' => 'image',
      'order'          => 'DESC',
      'post_status' => 'inherit',
      'posts_per_page' => -1
    ) );

    // var_dump('tototototto', $images );
    // var_dump('POST ID', $post->ID);
    // if we got some images, save the first in $thumbnail var
    if ( is_array( $images ) && ! empty( $images ) )
       $thumbnail = reset( $images );
    // var_dump('THUMBNAIL', $thumbnail );
    // if $thumbnail var is valid, set as featured for the post
    if ( $thumbnail instanceof \WP_Post )
       set_post_thumbnail( $post->ID, $thumbnail->ID );
  }

  public function generate_featured_image_as_bulk() {
    if ( (int) get_transient(' bulk_auto_set_featured' ) > 2 )
       return;

    $posts = get_posts( [
      'posts_per_page' => -1,
      'post_type' => 'post'
    ] ) ;
    // var_dump( $posts ); die();
    if ( empty( $posts ) )
      return;

    array_walk( $posts, array( $this, 'auto_set_featured') );
    // die();
    set_transient( 'bulk_auto_set_featured', 1 );
  }
}
