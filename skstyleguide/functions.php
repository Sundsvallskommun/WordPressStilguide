<?php
/**
 * Theme functions
 *
 * @since 1.0.0
 *
 * @package kingmary-wordpress-theme
 */

/**
 * Helpers.
 */
require_once locate_template( '/lib/helpers/general-template.php' );

/**
 * Theme basics and structure.
 */

require_once locate_template( '/lib/class-kingmary-init.php' );
$kingmary_init = new King_Mary_Init();

require_once locate_template( '/lib/class-kingmary-ajax.php' );
$kingmary_ajax = new King_Mary_Ajax();

require_once locate_template( '/lib/class-kingmary-post-types.php' );
$kingmary_post_types = new King_Mary_Post_Types();

require_once locate_template( '/lib/class-kingmary-menus.php' );
$kingmary_menus = new King_Mary_Menus();

require_once locate_template( '/lib/class-kingmary-comments.php' );
$kingmaryg_comments = new King_Mary_Comments();

require_once locate_template( '/lib/class-kingmary-dashboard.php' );
$kingmaryg_dashboard = new King_Mary_Dashboard();

require_once locate_template( '/lib/class-kingmary-walker-sidebar-menu.php' );
