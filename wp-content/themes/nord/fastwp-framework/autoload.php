<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

// FastWP Framework - autoload

spl_autoload_register( function ( $file ) {

    if( file_exists( ( $fastwp_load_file = get_template_directory() . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/' . str_replace( array( '\\', 'fastwp_nord_' ), array( '/', '' ), $file ) . '.php' ) ) )
    require_once $fastwp_load_file;

} );