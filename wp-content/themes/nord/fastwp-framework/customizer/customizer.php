<?php

// FastWP Framework - customizer

namespace fastwp_nord_customizer;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class customizer {

    /* Require sections */

    public static function require_sections( $wp_customize ) {
        $files = glob( FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/customizer/section_*.php' );
        foreach( $files as $file ) {

            require_once $file;

            $class_name = str_replace( '.php', '', basename( $file ) );
            $class = __NAMESPACE__ . '\\' . $class_name;

            if( class_exists( $class ) ) {
                new $class( $wp_customize );
            }
        }
    }

    /* Register */

    public static function register( $wp_customize ) {
        self::require_sections( $wp_customize );
    }

    /* Sanitize - checkbox */

    public static function sanitize_checkbox( $input ) {
    	if ( 1 == $input )
    		return true;
        else
    		return false;
    }

    /* Sanitize - textarea */

    public static function sanitize_textarea( $input ) {
        return $input;
    }

    /* Sanitize - select */

    public static function sanitize_select( $input ) {
        return $input;
    }

}