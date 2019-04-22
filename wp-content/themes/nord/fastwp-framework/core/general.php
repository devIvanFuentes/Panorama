<?php

// FastWP Framework - general

namespace fastwp_nord_core;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class general {

    private static $theme_support = array();

    /* Add theme support */

    public static function add_theme_support( $options = '', $args = array() ) {
        if( !empty( $options ) )
        if( !is_array( $options ) ) $options = array_map( 'trim', explode( ',', $options ) );
        foreach( $options as $option ) {
            self::$theme_support[$option] = $args;
        }
    }

    public static function modify_theme_support( $option = '', $args = array() ) {
        if( isset( self::$theme_support[$option] ) ) {
            self::$theme_support[$option] = array_merge( self::$theme_support[$option], $args );
        }
    }

    public static function remove_theme_support( $id = '' ) {
        if( isset( self::$theme_support[$id] ) ) {
            unset( self::$theme_support[$id] );
        }
    }

    public static function list_of_theme_support() {
        return self::$theme_support;
    }

    public static function default_theme_support() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'automatic-feed-links' );
    }

    public static function register_theme_support() {
        if( !empty( self::$theme_support ) && function_exists( 'add_theme_support' ) ) {
            foreach( self::$theme_support as $option => $args ) {
                if( !empty( $args ) ) {
                    add_theme_support( $option, $args );
                } else {
                    add_theme_support( $option );
                }
            }
        }
    }

    public static function text_domain_language_dir( $text_domain = '', $directory = 'language' ) {
        load_theme_textdomain( $text_domain, FASTWP_NORD_DIR . '/' . $directory );
    }

}