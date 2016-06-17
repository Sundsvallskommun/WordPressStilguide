<?php
/**
 * Custom post types.
 *
 * Register theme specific post types and taxonomies.
 *
 * @since 1.0.0
 *
 * @package kingmary-wordpress-theme
 */
class King_Mary_Post_Types {
	public function __construct() {
		add_action( 'init', array( &$this, 'register_post_types' ) );
	}

  /**
   * Register custom post types and taxonomies.
   *
   * @since 1.0.0
   *
   * @return null
   */
	public function register_post_types() {
		// Register post types and taxonomies here

    // $this->post_type_name();
    // $this->taxonomy_name();
    // ...
	}

  /**
   * Custom post type name
   *
   * @since 1.0.0
   * @access private
   *
   * @return null
   */
  private function post_type_name() {

  }
}