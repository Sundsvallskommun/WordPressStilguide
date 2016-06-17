<?php
/**
 * Get Wordpress base directory.
 *
 * @since 1.0.0
 *
 * @return null
 */
function wp_base_dir() {
	preg_match( '!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches );

	if ( count( $matches ) === 3 ) {
		return end( $matches );
	}

	return '';
}

/**
 * Outputs icon markup for icon from icons.svg.
 *
 * @since 1.0.0
 *
 * @param string $icon Icon name.
 * @param (int|array)    $size    Optional. Integer if square, array(w, h) if not
 *
 * @return null
 */
function icon( $icon, $size = 96 ) {
	echo __icon( $icon, $size );
}

/**
 * Generate icon markup for icon from icons.svg.
 *
 * @since 1.0.0
 *
 * @param string $icon Icon name, with or without the icon-prefix.
 * @param (int|array)    $size    Optional. Integer if square, array(w, h) if not
 *
 * @return null
 */
function __icon( $icon, $size = 96 ) {
	$size = ( is_array( $size ) ) ? $size[0] . ' ' . $size[1] : $size . ' ' . $size;
	$icon = strrpos( $icon, 'icon-' ) !== false ? $icon : 'icon-' . $icon;

	ob_start();
	?>
	<svg viewBox="0 0 <?php echo $size; ?>">
		<use xlink:href="#<?php echo $icon; ?>"></use>
	</svg>
	<?php

	$svg = ob_get_contents();
	ob_end_clean();

	return $svg;
}

/**
 * Get post thumbnail alternative text.
 *
 * @since 1.0.0
 *
 * @param int $post_id Post ID
 *
 * @return string
 */
function get_post_thumbnail_alt( $post_id = null ) {
	if ( $post_id == null ) {
		global $post;
		$post_id = $post->ID;
	}

	$thumbnail_id = get_post_thumbnail_id( $post_id );

	if ( empty( $thumbnail_id ) ) {
		return false;
	}

	return get_image_alt( $thumbnail_id );
}

/**
 * Get image alternative text.
 *
 * @since 1.0.0
 *
 * @param int $image_od Image post ID
 *
 * @return string
 */
function get_image_alt( $image_id ) {
	return get_post_meta( $image_id, '_wp_attachment_image_alt', true );
}

/**
 * Function placeholder_image
 *
 *
 * @param $size_x
 * @param $size_y
 *
 * @return string
 *
 * @since 1.0.0
 * @author Jonatan Olsson <jonatan@kingmary.se>
 */
function placeholder_image( $size_x, $size_y ) {
	return "https://unsplash.it/" . $size_x . '/' . $size_y . '/?random';
}


/**
 * Function custom_excerpt_length
 *
 *
 * @param $length
 *
 * @return string
 *
 * @since 1.0.0
 * @author Tomas Wisten <tomas@kingmary.se>
 */
function custom_excerpt_length( $length ) {
	return 12;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

