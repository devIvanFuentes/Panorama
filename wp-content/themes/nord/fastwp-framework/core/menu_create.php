<?php

// FastWP Framework - create menu

namespace fastwp_nord_core;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class menu_create {

    /* Create menu */

    function __construct( $menu, $args = array( 'depth' => 1 ) ) {
        $this->menu = $menu;
        $this->args = $args;
        $this->links = $this->generate_links();
    }

    function get_grouped_links() {
        $l = array();

        if( !empty( $this->links  ) )

        foreach( $this->links as $k => $link ) {

            if( empty( $link['menu_item_parent'] ) ) {
                $l[$k] = $link;
                if( !empty( $link['childrens'] ) ) {
                    $this->get_links( $l[$k], $link['childrens'] );
                }
            }
        }

        return $l;
    }

    function get_links( &$l, $childs ) {
        foreach( $childs as $child ) {
            $link = $this->links[$child];

            $l['subnav'][$link['ID']] = $link;

            if( !empty( $link['childrens'] ) ) {
                $this->get_links( $l['subnav'][$link['ID']], $link['childrens'] );
            }
        }
    }

    function generate_links() {
        global $post;

        $current_id = isset( $post->ID ) ? $post->ID : false;

        if( is_home() ) {
            $current_id = get_option( 'page_for_posts' );
        }

        $locations = get_nav_menu_locations();

        if( !in_array( $this->menu, array_keys( $locations ) ) ) {
            return false;
        }

        $links = wp_get_nav_menu_items( $locations[$this->menu], $this->args );

        if( empty( $links ) ) {
            return false;
        }

        $links = (array) $links;

        if( !$links ) {
            return false;
        }

        $l = array();

        array_map( function( $v ) use ( &$l, $current_id ) {
            $l[$v->ID] = (array) $v;
            if( !empty( $v->menu_item_parent ) ) {
                $l[$v->menu_item_parent]['childrens'][] = $v->ID;
            }
            if( isset( $v->object_id ) && $v->object_id == $current_id ) {
                $l[$v->ID]['is_active'] = true;
                if( !empty( $v->menu_item_parent ) ) {
                    $l[$v->menu_item_parent]['children_is_active'] = true;
                }
            }
        }, $links );

        return $l;
    }

}
