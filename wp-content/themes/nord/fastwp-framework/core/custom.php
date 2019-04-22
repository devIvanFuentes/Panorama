<?php

// FastWP Framework - custom

namespace fastwp_nord_core;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class custom {

    private static $custom_posts = array();
    private static $custom_taxonomies = array();
    private static $custom_fields = array();
    private static $sidebars = array();

    /* Manage custom posts */

    public static function add_custom_post( $id = '', $slug = '', $args = array() ) {
        if( !empty( $id ) && !empty( $slug ) )
        self::$custom_posts[$id] = array();
        self::$custom_posts[$id] = array_merge( array(
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'author', 'editor', 'excerpt', 'thumbnail' )
            ),
            $args );
        self::$custom_posts[$id]['rewrite']['slug'] = $slug;
    }

    public static function modify_custom_post( $id = '', $args = array() ) {
        if( isset( self::$custom_posts[$id] ) ) {
            self::$custom_posts[$id] = array_merge( self::$custom_posts[$id], $args );
        }
    }

    public static function remove_custom_post( $id = '' ) {
        if( isset( self::$custom_posts[$id] ) ) {
            unset( self::$custom_posts[$id] );
        }
    }

    public static function list_of_custom_posts() {
        return self::$custom_posts;
    }

    public static function add_custom_field( $post = '', $field_id = '', $field_name = '', $callback = '' ) {
        self::$custom_fields[$post][$field_id] = array( 'name' => $field_name, 'callback' => $callback );
    }

    public static function register_custom_fields() {
        $fields = self::$custom_fields;
        if( !empty( $fields ) ) {
            foreach( $fields as $custom_post => $cpfields ) {

                foreach( $cpfields as $field_id => $field ) {

                    add_filter( 'manage_edit-' . $custom_post . '_columns', function( $columns ) use ( $field_id, $field ) {
                        $columns[$field_id] = $field['name'];
                        return $columns;
                    } );

                    add_action( 'manage_' . $custom_post . '_posts_custom_column' , $field['callback'], 10, 2 );

                }

            }
        }
    }

    /* Manage custom taxonomies */

    public static function add_custom_taxonomy( $id = '', $post = '', $args = array() ) {
        if( !empty( $id ) && !empty( $slug ) )
        self::$custom_taxonomies[$id] = array();
        self::$custom_taxonomies[$id] = array_merge( array(
    		'hierarchical'      => true,
    		'show_ui'           => true,
    		'show_admin_column' => true,
    		'query_var'         => true
            ),
            $args );
        self::$custom_taxonomies[$id]['post'] = $post;
        self::$custom_taxonomies[$id]['rewrite']['slug'] = $id;
    }

    public static function modify_custom_taxonomy( $id = '', $args = array() ) {
        if( isset( self::$custom_taxonomies[$id] ) ) {
            self::$custom_taxonomies[$id] = array_merge( self::$custom_taxonomies[$id], $args );
        }
    }

    public static function remove_custom_taxonomy( $id = '' ) {
        if( isset( self::$custom_taxonomies[$id] ) ) {
            unset( self::$custom_taxonomies[$id] );
        }
    }

    public static function list_of_custom_taxonomies() {
        return self::$custom_taxonomies;
    }

    /* Manage widget areas */

    public static function add_widget_area( $id = '', $name = '', $args = array() ) {
        if( !empty( $id ) && !empty( $name ) )
        self::$sidebars[$id] = array_merge( array(
            'description'   => '',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
        	'after_widget'  => '</div>',
        	'before_title'  => '<h2 class="widget-title">',
        	'after_title'   => '</h2>',
        ),
        $args );
        self::$sidebars[$id]['id']  = $id;
        self::$sidebars[$id]['name'] = $name;
    }

    public static function register_widget_areas() {
        $sidebars = self::$sidebars;
        if( !empty( $sidebars ) )
        foreach( $sidebars as $sidebar_id => $sidebar ) {
            register_sidebar( $sidebar );
        }
    }

}

// Init filters & actions

add_filter( 'fastwp_nord_custom_posts_list', array( 'fastwp_nord_core\custom', 'list_of_custom_posts' ), 10 );
add_filter( 'fastwp_nord_custom_taxonomies_list', array( 'fastwp_nord_core\custom', 'list_of_custom_taxonomies' ), 10 );
add_action( 'init', array( 'fastwp_nord_core\custom', 'register_custom_fields' ) );
add_action( 'widgets_init', array( 'fastwp_nord_core\custom', 'register_widget_areas' ) );