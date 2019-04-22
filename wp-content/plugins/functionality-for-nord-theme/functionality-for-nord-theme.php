<?php

/**
 * Plugin Name:       Functionality for Nord theme
 * Plugin URI:        http://fastwp.net/
 * Description:       This plugin contains Nord theme core functionality
 * Version:           1.0.0
 * Author:            FastWP
 * Author URI:        https://fastwp.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       functionality-for-nord-theme
 */

/*** If this file is called directly, abort. ***/
if ( !defined( 'WPINC' ) ) {
	die;
}

/*** Define Nord Theme constants ***/

if( !defined( 'FASTWP_NORD_FRAMEWORK_DIR' ) ) {
    define( 'FASTWP_NORD_FRAMEWORK_DIR', 'fastwp-framework' );
}

if( !defined( 'FASTWP_NORD_DIR' ) ) {
    define( 'FASTWP_NORD_DIR', get_template_directory() );
}

if( !defined( 'FASTWP_NORD_URI' ) ) {
    define( 'FASTWP_NORD_URI', get_template_directory_uri() );
}

/*** Autoload ***/

if( ( $fastwp_nord_autoload = get_template_directory() . '/fastwp-framework/autoload.php' ) && file_exists( $fastwp_nord_autoload ) ) {

    require_once $fastwp_nord_autoload;

    /*** Check if Nord's main class exists ***/

    if( class_exists( 'fastwp_nord_core\main' ) ) {

    /***

        NORD THEME CUSTOM POSTS/CUSTOM TAXONOMIES AND OPTIONS

    ***/

    /*** List of custom columns for posts ***/

    fastwp_nord_core\main::add_custom_field( 'fwp_portfolio', 'item_id', esc_html__( 'Item ID', 'nord' ), function( $column, $post_id ) {
            if( $column == 'item_id' ) {
                echo $post_id;
            }
        }
    );

    fastwp_nord_core\main::add_custom_field( 'fwp_portfolio', 'thumb', esc_html__( 'Preview', 'nord' ), function( $column, $post_id ) {
            if( $column == 'thumb' ) {
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'medium' );
                if( isset( $image[0] ) )
                echo '<img src="' . $image[0] . '" style="max-width: 128px; max-height: 128px;" />';
            }
        }
    );

    /*** List of the custom taxonomies used in Nord Theme ***/

    fastwp_nord_core\main::add_custom_taxonomy( 'portfolio-category', 'fwp_portfolio', array(
        'labels' => array(
            'menu_name'         => esc_html__( 'Categories', 'nord' ),
            'singular_name'     => esc_html__( 'Category Item', 'nord' ),
            'name'              => esc_html__( 'Category Items', 'nord' )
            )
        )
    );



    /*** Register shortcodes, custom posts, custom taxonomies ***/

    class fastwp_nord_main extends fastwp_nord_core\main {

        public static function register_shortcodes() {
            $shortcodes = self::list_of_shortcodes();
            if( !empty( $shortcodes ) )
            foreach( $shortcodes as $shortcode => $callback ) {
                add_shortcode( $shortcode, $callback );
            }
        }

        public static function register_custom_posts() {
            /* Add new custom posts before registering */
            $fastwp_nord_project_slug = class_exists( 'fastwp_nord_theme\utils' ) && ( $fwp_slug = fastwp_nord_theme\utils::get_option( 'fwp_portfolio_slug' ) ) != '' ? $fwp_slug : 'fwp_project';

            fastwp_nord_core\main::add_custom_post( 'fwp_portfolio', $fastwp_nord_project_slug, array(
                'labels' => array(
                    'menu_name'         => esc_html__( 'Portfolio', 'nord' ),
                    'singular_name'     => esc_html__( 'Portfolio Item', 'nord' ),
                    'name'              => esc_html__( 'Portfolio Items', 'nord' )
                    )
                )
            );

            $custom_posts = self::list_of_custom_posts();
            if( !empty( $custom_posts ) )
            foreach( $custom_posts as $custom_post_id => $custom_post ) {
                register_post_type( $custom_post_id, $custom_post );
            }
        }

        public static function register_custom_taxonomies() {
            $custom_taxonomies = self::list_of_custom_taxonomies();
            if( !empty( $custom_taxonomies ) )
            foreach( $custom_taxonomies as $custom_taxonomy_id => $custom_taxonomy ) {
                register_taxonomy( $custom_taxonomy_id, $custom_taxonomy['post'], $custom_taxonomy );
            }
        }

    }

    // Init filters & actions

    add_action( 'init', array( 'fastwp_nord_main', 'register_shortcodes' ), 11 );
    add_action( 'init', array( 'fastwp_nord_main', 'register_custom_posts' ), 10 );
    add_action( 'init', array( 'fastwp_nord_main', 'register_custom_taxonomies' ), 10 );

    }

}

/* Helpful & markup generator */

if( !function_exists( 'fastwp_b64_decode' ) ) {
    function fastwp_b64_decode( $text ) {
        return base64_decode( $text );
    }
}

if( !function_exists( 'fastwp_nord_share_links' ) ) {
    function fastwp_nord_share_links( $before = '' ) {
        echo $before;
        echo '<h6>' . esc_html__( 'Share', 'nord' ) . '</h6>';
        echo '<ul class="social share">
    		<li><a href="' . esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() ) . '"><i class="fa fa-facebook"></i></a></li>
    		<li><a href="' . esc_url( 'https://twitter.com/home?status=' . get_the_permalink() ) . '"><i class="fa fa-twitter"></i></a></li>
    		<li><a href="' . esc_url( 'https://plus.google.com/share?url=' . get_the_permalink() ) . '"><i class="fa fa-google"></i></a></li>
    		<li><a href="' . esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_the_permalink() ) . '"><i class="fa fa-pinterest"></i></a></li>
    	</ul>';
    }
}