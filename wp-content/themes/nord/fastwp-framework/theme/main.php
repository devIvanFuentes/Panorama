<?php

// FastWP Framework - main

namespace fastwp_nord_theme;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class main {

    /* Check if navigation is active */

    public static function posts_nav_active() {
        global $wp_query;
        if( $wp_query->max_num_pages > 1 ) {
            return true;
        }
        return false;
    }

    /* Check if next posts page should be visible */

    public static function next_posts_nav_active() {
           global $paged, $wp_query;
           if( $paged < $wp_query->max_num_pages ) {
               return true;
           }
           return false;
    }

    /* Check if previous posts page should be visible */

    public static function previous_posts_nav_active() {
           global $paged;
           if( $paged > 0 ) {
               return true;
           }
           return false;
    }

    /* Check if navigation on single post is active */

    public static function single_post_navigation( $show_title = false ) {
        list( $prev, $next ) = array( get_previous_post(), get_next_post() );
        if( empty( $prev ) && empty( $next ) ) {
            return false;
        }
        $links = array();
        if( !empty( $prev ) ) {
            $links['previous'] = array( 'postID' => $prev->ID, 'title' => ( $show_title ? $prev->post_title : esc_html__( 'Previous Post', 'nord' ) ) );
        }
        if( !empty( $next ) ) {
            $links['next'] = array( 'postID' => $next->ID, 'title' => ( $show_title ? $next->post_title : esc_html__( 'Next Post', 'nord' ) ) );
        }
        return $links;
    }

    /* Get content for post type */

    public static function single_post_type( $path, $use_thumb_to_img = false ) {
        $post_type = get_post_format();
        if( empty( $post_type ) && $use_thumb_to_img ) {
            $post_type = 'image';
        }
        $post_type_file = rtrim( $path, '/' ) . '/' . $post_type . '.php';
        if( file_exists( $post_type_file ) ) {
            include $post_type_file;
        }
    }

    /* Get posts */

    public static function get_posts() {
        $query_options = array(
                                'posts_per_page'    => -1,
                            );

        $loop = new \WP_Query( $query_options );

        $posts = array();

        if( $loop->have_posts() ) {
            while ( $loop->have_posts() ) {
                $loop->the_post();

                $posts[get_the_ID()] = get_the_title();
            }
            wp_reset_query();
        }

        return $posts;
    }

}