<?php
/**
 * Theme menu registration.
 *
 * @since 1.0.0
 *
 * @package kingmary-wordpress-theme
 */
class King_Mary_Menus {
  public function __construct() {
    add_action( 'init', array( &$this, 'register_nav_menus' ) );
  }

  /**
   * Theme menus.
   *
   * @since 1.0.0
   * 
   * @return null
   */
  public function register_nav_menus() {
    register_nav_menus( array(
      'main-menu' => 'Huvudmeny',
    ) );
  }
}