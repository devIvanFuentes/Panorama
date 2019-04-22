<?php

// FastWP Framework - markup

namespace fastwp_nord_theme;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class markup {

    /* Get the menu */

    public static function the_menu( $menu = 'primary' ) {
        $menu   = new \fastwp_nord_core\menu_create( $menu );
        $links  = $menu->get_grouped_links();
        $markup = '';

        if( !empty( $links ) ) {
            $markup .= '<ul class="menu">';

            foreach( $links as $link ) {
                $markup .= '<li' . ( !empty( $link['classes'] ) ? ' class="' . esc_attr( implode( ' ', $link['classes'] ) ) . '"' : '' ) . '>
                <a href="' . esc_url( $link['url'] ) . '" class="ajax-link' . ( !empty( $link['is_active'] ) || !empty( $link['children_is_active'] ) ? ' active' : '' ) . '"' .
                ( !empty( $link['target'] ) ? ' target="' . esc_attr( $link['target'] ) . '"' : '' ) . ( !empty( $link['attr_title'] ) ? ' title="' . esc_attr( $link['attr_title'] ) . '"' : '' ) . '>' . esc_html( $link['title'] ) . '</a>';
                if( !empty( $link['subnav'] ) ) {
                    self::the_submenu_links( $markup, $link['subnav'], $link['ID'] );
                }
                $markup .= '</li>';
            }

            $markup .= '</ul>';
        }

        return $markup;
    }

    /* Get the submenu */

    private static function the_submenu_links( &$markup, $main_link ) {
        $markup .= '<ul class="submenu">';

        foreach( $main_link as $link ) {
            $markup .= '<li' . ( !empty( $link['classes'] ) ? ' class="' . implode( ' ', $link['classes'] ) . '"' : '' ) . '>
            <a href="' . esc_url( $link['url'] ) . '"' . ( !empty( $link['is_active'] ) || !empty( $link['children_is_active'] ) ? ' class="active"' : '' ) .
            ( !empty( $link['target'] ) ? ' target="' . esc_html( $link['target'] ) . '"' : '' ) . ( !empty( $link['attr_title'] ) ? ' title="' . esc_html( $link['attr_title'] ) . '"' : '' ) . '>' . esc_html( $link['title'] ) . '</a>';

            if( !empty( $link['subnav'] ) ) {
                self::the_submenu_links( $markup, $link['subnav'] );
            }
            $markup .= '</li>';
        }

        $markup .= '</ul>';
    }

    /* Get the category */

    public static function the_category( $post = 0 ) {
        $category = get_the_category( $post );
        if( !empty( $category ) ) {
            echo '<span class="cat">';
            $i = 1;
            $cats = count( $category );
            foreach( $category as $cat ) {
                echo '<a href="' . get_category_link( $cat->term_id ) . '" class="link">' . $cat->name . '</a>';
                if( $i != $cats ) {
                    echo ', ';
                }
                $i++;
            }
            echo '</span>';
        }
    }

}