<?php
/**
 * Sidebar menu custom walker.
 *
 * @since 1.0.0
 *
 * @package kingmary-wordpress-theme
 */
class King_Mary_Walker_Sidebar_Menu extends Walker_Nav_Menu {
  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    global $wp_query;
    
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
    $class_names = ' class="'. esc_attr( $class_names ) . '"';

    $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    $prepend = '';
    $append = '';
    $description  = ! empty( $item->description ) ? '<span>' . esc_attr( $item->description ) .'</span>' : '';

    if($depth != 0) {
       $description = $append = $prepend = "";
    }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';

    /*if( $item->menu_item_parent == 0 && !empty( $item->classes ) && in_array( 'menu-item-has-children', $item->classes ) ) {
        $item_output .= '<span><i class="icon"><svg viewBox="0 0 96 96"><g><use xlink:href="#icon-arrow"></use></g></svg></i></span>';
    }*/

    $item_output .= $args->link_before . $prepend . apply_filters( 'the_title', $item->title, $item->ID ) . $append;
    $item_output .= $description . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}