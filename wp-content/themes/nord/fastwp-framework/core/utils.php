<?php

// FastWP Framework - Utils

namespace fastwp_nord_core;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class utils {

    /*  */

    public static function kses_escape( $text = '' ) {
        $a_tags = array();
        $a_tags['strong']   = array( 'id' => array(), 'class' => array() );
	    $a_tags['small']    = array( 'id' => array(), 'class' => array() );
	    $a_tags['span']     = array( 'id' => array(), 'class' => array() );
    	$a_tags['abbr']     = array( 'id' => array(), 'class' => array() );
	    $a_tags['code']     = array( 'id' => array(), 'class' => array() );
	    $a_tags['div']      = array( 'id' => array(), 'class' => array() );
	    $a_tags['img']      = array( 'id' => array(), 'class' => array() );
	    $a_tags['h1']       = array( 'id' => array(), 'class' => array() );
	    $a_tags['h2']       = array( 'id' => array(), 'class' => array() );
	    $a_tags['h3']       = array( 'id' => array(), 'class' => array() );
	    $a_tags['h4']       = array( 'id' => array(), 'class' => array() );
	    $a_tags['h5']       = array( 'id' => array(), 'class' => array() );
	    $a_tags['ol']       = array( 'id' => array(), 'class' => array() );
	    $a_tags['ul']       = array( 'id' => array(), 'class' => array() );
	    $a_tags['li']       = array( 'id' => array(), 'class' => array() );
	    $a_tags['em']       = array( 'id' => array(), 'class' => array() );
	    $a_tags['p']        = array( 'id' => array(), 'class' => array() );
	    $a_tags['a']        = array( 'id' => array(), 'class' => array(), 'href'  => array(), 'rel'   => array(),'title' => array() );

        return wp_kses( $text, $a_tags );
    }

}