<?php

// FastWP Framework - filters

namespace fastwp_nord_theme;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class utils {

    public static function parse_vc_link( $string ) {
        $opts   = explode( '|', urldecode( $string ) );
        $link   = array();
        foreach( $opts as $opt ) {
            $line   = explode( ':', $opt );
            $key    = $line[0];
            unset( $line[0] );
            $link[$key] = implode( ':', $line );
        }
        return array_filter( $link );
    }

    public static function get_option( $option, $default = false ) {
        global $fastwp_nord_data;
        if( isset( $fastwp_nord_data[$option] ) ) {
            return $fastwp_nord_data[$option];
        }
        return $default;
    }

}