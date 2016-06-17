<?php
/**
 * General theme settings.
 *
 * Controls settings like image sizes, what files that can be uploaded, etc.
 *
 * @since 1.0.0
 *
 * @package kingmary-wordpress-theme
 */
define( 'PRODUCTION_MODE', false );
define( 'COOKIE_WARNING', false );

class King_Mary_Init {
	public function __construct() {
		// Actions and filters
		add_action( 'init', array( &$this, 'init' ) );
		add_action( 'init', array( &$this, 'options_page' ) );
		add_action( 'after_setup_theme', array( &$this, 'after_setup_theme' ) );
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
		add_action( 'login_head', array( &$this, 'login_head' ) );
		add_action( 'generate_rewrite_rules', array( &$this, 'generate_rewrite_rules' ) );
		add_action( 'after_setup_theme', array( &$this, 'add_editor_styles' ) );
		add_filter( 'tiny_mce_before_init', array( &$this, 'tinymce_custom_format' ) );
		add_filter( 'intermediate_image_sizes_advanced', array( &$this, 'filter_image_sizes' ) );
		add_filter( 'image_size_names_choose', array( &$this, 'image_size_name' ) );
	}

	/**
	 * Filter initialization on Wordpress init.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function init() {
		add_filter( 'sanitize_file_name', array( &$this, 'sluggify' ), 10 );
		add_filter( 'upload_mimes', array( &$this, 'custom_upload_mimes' ) );
		
		$this->cleanup_wp_head();
	}

	/**
	 * Custom options pages positon.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function options_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			/*acf_add_options_page( array(
				'page_title' 	=> 'Webbplatsen',
				'menu_title'	=> 'Webbplatsen',
				'menu_slug' 	=> 'general-settings',
				'parent_slug'	=> '',
				'redirect'		=> true,
				'position'		=> '59,5'
			) );
			
			acf_add_options_sub_page( array(
				'page_title' 	=> 'Tema',
				'menu_title'	=> 'Tema',
				'parent_slug'	=> 'general-settings',
			) );*/
		}
	}

	/**
	 * Define what the theme should support.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function after_setup_theme() {
		// Image sizes
		//add_image_size('image-320', 320, 100, true);
		//add_image_size('image-640', 640, 200, true);
		//add_image_size('image-1000', 1000, 300, true);
		
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Save disk space by removing the 'large' image size.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function filter_image_sizes( $sizes ) {
		unset( $sizes['large'] );

		return $sizes;
	}

	/**
	 * Save disk space by removing the 'large' image size.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function image_size_name( $sizes ) {
		unset( $sizes['large'] );

		//$sizes['image-320']  = 'Label for size';
		//$sizes['image-640']  = 'Label for size';
		//$sizes['image-1000'] = 'Label for size';

		return $sizes;
	}

	/**
	 * Remove media options page.
	 *
	 * The page isn't used and only confuses the administrators.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function admin_menu() {
		remove_submenu_page( 'options-general.php', 'options-media.php' );
	}
	
	/**
	 * Add a nice login head image.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function login_head() {
		?>
		<style>
			#login h1 { background: url('<?php echo get_template_directory_uri(); ?>/assets/images/login-logo.png') no-repeat top center; }
			#login h1 a { background: none; }
			
			@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
				#login h1 { background: url('<?php echo get_template_directory_uri(); ?>/assets/images/login-logo@2x.png') no-repeat top center; background-size: 320px auto; }
			}
		</style>
		<?php
	}

	/**
	 * Fix post slug.
	 *
	 * Only accept a-z0-9 in post slugs.
	 *
	 * @since 1.0.0
	 *
	 * @param string $filename
	 * @param boolean $file
	 *
	 * @return null
	 */
	public function sluggify( $filename, $file = true ) {
		if( false !== $file ) {
			$info = pathinfo( $filename );  
			$ext  = empty( $info['extension'] ) ? '' : '.' . $info['extension'];
			$name = basename( $filename, $ext );
			$name = str_replace( $ext, '', $name );
		}
		else {
			$name = $filename;
		}

		$name = trim( strtolower( preg_replace( '/([^\w]|-)+/', '-', trim( strtr( str_replace( '\'', '', trim( $name ) ), array(
				'À'=>'A','Á'=>'A','Â'=>'A','Ã'=>'A','Å'=>'A','Ä'=>'A','Æ'=>'AE',
				'à'=>'a','á'=>'a','â'=>'a','ã'=>'a','å'=>'a','ä'=>'a','æ'=>'ae',
				'Þ'=>'B','þ'=>'b','Č'=>'C','Ć'=>'C','Ç'=>'C','č'=>'c','ć'=>'c',
				'ç'=>'c','Ď'=>'D','ð'=>'d','ď'=>'d','Đ'=>'Dj','đ'=>'dj','È'=>'E',
				'É'=>'E','Ê'=>'E','Ë'=>'E','è'=>'e','é'=>'e','ê'=>'e','ë'=>'e',
				'Ì'=>'I','Í'=>'I','Î'=>'I','Ï'=>'I','ì'=>'i','í'=>'i','î'=>'i',
				'ï'=>'i','Ľ'=>'L','ľ'=>'l','Ñ'=>'N','Ň'=>'N','ñ'=>'n','ň'=>'n',
				'Ò'=>'O','Ó'=>'O','Ô'=>'O','Õ'=>'O','Ø'=>'O','Ö'=>'O','Œ'=>'OE',
				'ð'=>'o','ò'=>'o','ó'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','œ'=>'oe',
				'ø'=>'o','Ŕ'=>'R','Ř'=>'R','ŕ'=>'r','ř'=>'r','Š'=>'S','š'=>'s',
				'ß'=>'ss','Ť'=>'T','ť'=>'t','Ù'=>'U','Ú'=>'U','Û'=>'U','Ü'=>'U',
				'Ů'=>'U','ù'=>'u','ú'=>'u','û'=>'u','ü'=>'u','ů'=>'u','Ý'=>'Y',
				'Ÿ'=>'Y','ý'=>'y','ý'=>'y','ÿ'=>'y','Ž'=>'Z','ž'=>'z', '^'=>'',
				'¨'=>'', '´'=>'', '`'=>'', '"' => ''
				) ) ) ) ) );

		return $file !== false ? $name . $ext : $name;
	}
	
	/**
	 * Disable support for certain mime types.
	 *
	 * We never wan't certain image types to be uploaded.
	 *
	 * @since 1.0.0
	 *
	 * @param array $existing_mimes Default mime types.
	 *
	 * @return null
	 */
	public function custom_upload_mimes( $existing_mimes = array() ) {
		unset( $existing_mimes['bmp'] );
		unset( $existing_mimes['tif|tiff'] );

		return $existing_mimes;
	}

	/**
	 * Action for adding HTML5 Boilerplate .htaccess.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function generate_rewrite_rules() {
		$this->add_h5bp_htaccess();
	}

	/**
	 * Add HTML5 Boilerplate .htaccess.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	private function add_h5bp_htaccess() {
		global $wp_rewrite;

		$home_path = function_exists( 'get_home_path' ) ? get_home_path() : ABSPATH;
		$htaccess_file = $home_path . '.htaccess';
		$mod_rewrite_enabled = function_exists( 'got_mod_rewrite' ) ? got_mod_rewrite() : false;

		if ( ( ! file_exists( $htaccess_file ) && is_writable( $home_path ) && $wp_rewrite->using_mod_rewrite_permalinks() ) || is_writable( $htaccess_file ) ) {
			if ( $mod_rewrite_enabled ) {
				$h5bp_rules = extract_from_markers( $htaccess_file, 'HTML5 Boilerplate' );
				if ( $h5bp_rules === array() ) {
					$filename = dirname( __FILE__ ) .'/assets/h5bp-htaccess';
					return insert_with_markers( $htaccess_file, 'HTML5 Boilerplate', extract_from_markers( $filename, 'HTML5 Boilerplate' ) );
				}
			}
		}
	}

	/**
	 * Remove unwanted head meta.
	 *
	 * For example Wordpress-version. Originally from
	 * http://wpengineer.com/1438/wordpress-header/.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function cleanup_wp_head() {
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

		add_filter( 'use_default_gallery_style', '__return_null' );
	}

	/**
	 * WYSIWYG editor styles.
	 *
	 * @since 1.0.0
	 *
	 * @return null
	 */
	public function add_editor_styles() {
    add_editor_style( 'editor-style.css' );
	}

	/**
	 * Custom formatting for the WYSIYG.
	 *
	 * @since 1.0.0
	 *
	 * @param array $init_array
	 * 
	 * @return null
	 */
	public function tinymce_custom_format( $init_array ) {
	  $style_formats = array(  
	    array(  
	      'title' => 'Ingress',  
	      'block' => 'p',  
	      'classes' => 'text-lead',
	      'wrapper' => false,
	      
	    ),
	    array(  
	      'title' => 'Stycke',  
	      'block' => 'p',  
	      'classes' => '',
	      'wrapper' => false,
	      
	    ),
	    array(  
	      'title' => 'Rubrik 2',  
	      'block' => 'h2',  
	      'classes' => '',
	      'style' => "font-family:Georgia, 'Times New Roman', 'Bitstream Charter', Times, serif;font-size:20px;font-weight:bold;font-style:normal;text-decoration:none;text-transform:none;",
	      'wrapper' => false,
	      
	    ),
	    array(  
	      'title' => 'Rubrik 3',  
	      'block' => 'h3',  
	      'classes' => '',
	      'style' => "font-family:Georgia, 'Times New Roman', 'Bitstream Charter', Times, serif;font-size:15px;font-weight:bold;font-style:normal;text-decoration:none;text-transform:none;",
	      'wrapper' => false,
	      
	    )
	  );  

	  $init_array['style_formats'] = json_encode( $style_formats );  

	  return $init_array;
	}
}