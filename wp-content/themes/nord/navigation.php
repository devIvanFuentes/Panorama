<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

if( fastwp_nord_theme\main::posts_nav_active() ) {

the_posts_pagination( array(
    'screen_reader_text' => ' ',
        'mid_size'  => 2,
    	'prev_text' => '<i></i> <span>' . esc_html__( 'Prev Page', 'nord' ) . '</span>',
    	'next_text' => '<span>' . esc_html__( 'Next Page', 'nord' ) . '</span> <i></i>',
    ) );

} ?>