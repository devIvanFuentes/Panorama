<?php

// FastWP Framework - filters

namespace fastwp_nord_theme;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class options {

    public static function get_body_class() {
        \fastwp_nord_core\main::add_body_class( 'sticky-header sticky-footer' );
    }

}