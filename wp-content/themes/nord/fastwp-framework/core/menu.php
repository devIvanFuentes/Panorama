<?php

// FastWP Framework - menu

namespace fastwp_nord_core;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class menu {

    private static $menus = array();

    /* Manage menu */

    public static function add_menu( $id = '', $name = '' ) {
        if( !empty( $id ) && !empty( $name ) )
        self::$menus[$id] = $name;
    }

    public static function remove_menu( $id = '' ) {
        if( isset( self::$menus[$id] ) ) {
            unset( self::$menus[$id] );
        }
    }

    public static function list_of_menus() {
        return self::$menus;
    }

    public static function register_menus() {
        $menus = self::$menus;
        if( !empty( $menus ) )
        foreach( $menus as $menu => $name ) {
            register_nav_menu( $menu, $name );
        }
    }

}

// Init filters & actions

add_filter( 'init', array( 'fastwp_nord_core\menu', 'register_menus' ), 10 );