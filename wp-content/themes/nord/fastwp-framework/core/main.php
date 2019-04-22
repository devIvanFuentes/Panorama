<?php

// FastWP Framework - main

namespace fastwp_nord_core;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class main extends custom {

    private static $body_classes = array();
    private static $shortcodes = array();
    private static $widgets = array();
    private static $styles = array();
    private static $admin_styles = array();
    private static $scripts = array();
    private static $admin_scripts = array();

    /* Manage styles */

    public static function add_styles( $path = '', $styles = array(), $external = false, $style_id = '' ) {
        if( !empty( $styles ) )
        foreach( $styles as $style => $required ) {
            if( (boolean) $required ) {
                $style = $required;
                $required = true;
            }
            if( $external ) {
                self::$styles[$style_id] = array( 'path' => $path . ( !empty( $styles ) ? urlencode( implode( '|', (array) $styles ) ) : '' ), 'required' => $required );
            } else {
                if( !empty( $style_id ) ) $style = $style_id;
                self::$styles[$style] = array( 'path' => $path . '/' . $style . '.css', 'required' => $required );
            }
        }
    }

    public static function add_required_styles( $styles = array() ) {
        if( !empty( $styles ) )
        if( !is_array( $styles ) ) $styles = array_map( 'trim', explode( ',', $styles ) );
        foreach( $styles as $style ) {
            if( isset( self::$styles[$style] ) ) {
                self::$styles[$style]['required'] = true;
            }
        }
    }

    public static function add_style_version( $style = '', $version = '1.0.0' ) {
        if( isset( self::$styles[$style] ) ) {
            self::$styles[$style]['version'] = $version;
        }
    }

    public static function list_of_styles() {
        return self::$styles;
    }

    public static function register_styles() {
        $styles = self::$styles;
        if( !empty( $styles ) )
        foreach( $styles as $style_id => $style_options ) {
            wp_register_style( $style_id, $style_options['path'], array(), ( isset( $style_options['version'] ) ? $style_options['version'] : '1.0.0' ) );
            if( (boolean) $style_options['required'] ) {
                wp_enqueue_style( $style_id );
            }
        }
    }

    /* Manage admin styles */

    public static function add_admin_styles( $path = '', $styles = array() ) {
        if( !empty( $styles ) )
        foreach( $styles as $style => $required ) {
            if( (boolean) $required ) {
                $style = $required;
                $required = true;
            }
            self::$admin_styles[$style] = array( 'path' => $path . '/' . $style . '.css', 'required' => $required );
        }
    }

    public static function add_required_admin_styles( $styles = array() ) {
        if( !empty( $styles ) )
        if( !is_array( $styles ) ) $styles = array_map( 'trim', explode( ',', $styles ) );
        foreach( $styles as $style ) {
            if( isset( self::$admin_styles[$style] ) ) {
                self::$admin_styles[$style]['required'] = true;
            }
        }
    }

    public static function add_admin_style_version( $style = '', $version = '1.0.0' ) {
        if( isset( self::$admin_styles[$style] ) ) {
            self::$admin_styles[$style]['version'] = $version;
        }
    }

    public static function list_of_admin_styles() {
        return self::$admin_styles;
    }

    public static function register_admin_styles() {
        $styles = self::$admin_styles;
        if( !empty( $styles ) )
        foreach( $styles as $style_id => $style_options ) {
            wp_register_style( $style_id, $style_options['path'], array(), ( isset( $style_options['version'] ) ? $style_options['version'] : '1.0.0' ) );
            if( (boolean) $style_options['required'] ) {
                wp_enqueue_style( $style_id );
            }
        }
    }

    /* Manage scripts */

    public static function add_scripts( $path = '', $scripts = array() ) {
        if( !empty( $scripts ) ) {
            foreach( $scripts as $script => $required ) {
                if( (boolean) $required ) {
                    $script = $required;
                    $required = true;
                }
                self::$scripts[$script] = array( 'path' => $path . '/' . $script . '.js', 'required' => $required );
            }
        } else {
            self::$scripts[] = array( 'path' => $path, 'required' => true );
        }
    }

    public static function add_required_scripts( $scripts = array() ) {
        if( !empty( $scripts ) )
        if( !is_array( $scripts ) ) $scripts = array_map( 'trim', explode( ',', $scripts ) );
        foreach( $scripts as $script ) {
            if( isset( self::$scripts[$script] ) ) {
                self::$scripts[$script]['required'] = true;
            }
        }
    }

    public static function add_script_deps( $script = '', $deps = array() ) {
        if( isset( self::$scripts[$script] ) ) {
            if( isset( self::$scripts[$script]['deps'] ) ) {
                self::$scripts[$script]['deps'] = array_merge( self::$scripts[$script]['deps'], $deps );
            } else {
                self::$scripts[$script]['deps'] = $deps;
            }
        }
    }

    public static function add_script_version( $script = '', $version = '1.0.0' ) {
        if( isset( self::$scripts[$script] ) ) {
            self::$scripts[$script]['version'] = $version;
        }
    }

    public static function list_of_scripts() {
        return self::$scripts;
    }

    public static function register_scripts() {
        $scripts = self::$scripts;        
        if( !empty( $scripts ) )
        foreach( $scripts as $script_id => $script_options ) {
            wp_register_script( $script_id, $script_options['path'], ( isset( $script_options['deps'] ) ? $script_options['deps'] : array() ), ( isset( $script_options['version'] ) ? $script_options['version'] : '1.0.0' ), true );
            if( (boolean) $script_options['required'] ) {
                wp_enqueue_script( $script_id );
            }
        }
    }

    /* Manage admin scripts */

    public static function add_admin_scripts( $path = '', $scripts = array() ) {
        if( !empty( $scripts ) )
        foreach( $scripts as $script => $required ) {
            if( (boolean) $required ) {
                $script = $required;
                $required = true;
            }
            self::$admin_scripts[$script] = array( 'path' => $path . '/' . $script . '.js', 'required' => $required );
        }
    }

    public static function add_required_admin_scripts( $scripts = array() ) {
        if( !empty( $scripts ) )
        if( !is_array( $scripts ) ) $scripts = array_map( 'trim', explode( ',', $scripts ) );
        foreach( $scripts as $script ) {
            if( isset( self::$scripts[$script] ) ) {
                self::$admin_scripts[$script]['required'] = true;
            }
        }
    }

    public static function add_admin_script_deps( $script = '', $deps = array() ) {
        if( isset( self::$admin_scripts[$script] ) ) {
            if( isset( self::$admin_scripts[$script]['deps'] ) ) {
                self::$admin_scripts[$script]['deps'] = array_merge( self::$admin_scripts[$script]['deps'], $deps );
            } else {
                self::$admin_scripts[$script]['deps'] = $deps;
            }
        }
    }

    public static function add_admin_script_version( $script = '', $version = '1.0.0' ) {
        if( isset( self::$admin_scripts[$script] ) ) {
            self::$admin_scripts[$script]['version'] = $version;
        }
    }

    public static function list_of_admin_scripts() {
        return self::$admin_scripts;
    }

    public static function register_admin_scripts() {
        $scripts = self::$admin_scripts;
        if( !empty( $scripts ) )
        foreach( $scripts as $script_id => $script_options ) {
            wp_register_script( $script_id, $script_options['path'], ( isset( $script_options['deps'] ) ? $script_options['deps'] : array() ), ( isset( $script_options['version'] ) ? $script_options['version'] : '1.0.0' ), true );
            if( (boolean) $script_options['required'] ) {
                wp_enqueue_script( $script_id );
            }
        }
    }

    /* Manage shortcodes */

    public static function prepare_shortcodes() {
        $files = glob( FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/shortcodes/*.php' );
        foreach( $files as $file ) {
            require_once $file;
            $class_name = 'fastwp_nord_shortcodes\\' . str_replace( '.php', '', basename( $file ) );
            if( class_exists( $class_name ) ) {
                new $class_name;
            }
        }
    }

    public static function add_new_shortcode( $shortcode = '', $callback = '' ) {
        self::$shortcodes[$shortcode] = $callback;
    }

    public static function remove_shortcode( $shortcode = '' ) {
        if( isset( self::$shortcodes[$shortcode] ) ) {
            unset( self::$shortcodes[$shortcode] );
        }
    }

    public static function list_of_shortcodes() {
        self::prepare_shortcodes();
        return self::$shortcodes;
    }

    /* Manage widgets */

    public static function prepare_widgets() {
        $files = glob( get_template_directory() . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/widgets/*.php' );
        foreach( $files as $file ) {
            require_once $file;
            $class_name = str_replace( '.php', '', basename( $file ) );
            if( class_exists( $class_name ) ) {
                new $class_name;
            }
        }
    }

    public static function add_widget( $widget = '', $callback = '' ) {
        self::$widgets[$widget] = $callback;
    }

    public static function remove_widget( $widget = '' ) {
        if( isset( self::$widgets[$widget] ) ) {
            unset( self::$widgets[$widget] );
        }
    }

    public static function list_of_widgets() {
        self::prepare_widgets();
        return self::$widgets;
    }

    /* Manage body classes */

    public static function add_body_class( $classes = array() ) {
        if( is_array( $classes ) ) {
            foreach( $classes as $class ) {
                self::$body_classes[esc_attr( $class )] = '';
            }
        } else {
            self::$body_classes[esc_attr( $classes )] = '';
        }
    }

    public static function remove_body_class( $class = '' ) {
        if( isset( self::$body_classes[$class] ) ) {
            unset( self::$body_classes[$class] );
        }
    }

    public static function body_class( $classes = array() ) {
        return array_merge( $classes, array_keys( self::$body_classes ) );

    }

}

// Init filters & actions

add_filter( 'body_class', array( 'fastwp_nord_core\main', 'body_class' ), 10 );
add_filter( 'fastwp_nord_shortcodes_list', array( 'fastwp_nord_core\main', 'list_of_shortcodes' ), 10 );
add_filter( 'fastwp_nord_widgets_list', array( 'fastwp_nord_core\main', 'list_of_widgets' ), 10 );
add_action( 'fastwp_nord_add_body_class', array( 'fastwp_nord_core\main', 'add_body_class' ), 10, 1 );
add_action( 'fastwp_nord_require_styles', array( 'fastwp_nord_core\main', 'add_required_styles' ), 10, 1 );
add_action( 'fastwp_nord_require_admin_styles', array( 'fastwp_nord_core\main', 'add_required_admin_styles' ), 10, 1 );
add_action( 'fastwp_nord_require_scripts', array( 'fastwp_nord_core\main', 'add_required_scripts' ), 10, 1 );
add_action( 'fastwp_nord_require_admin_scripts', array( 'fastwp_nord_core\main', 'add_required_admin_scripts' ), 10, 1 );
add_action( 'wp_enqueue_scripts', array( 'fastwp_nord_core\main', 'register_scripts' ), 10 );
add_action( 'wp_enqueue_scripts', array( 'fastwp_nord_core\main', 'register_styles' ), 10 );
add_action( 'admin_enqueue_scripts', array( 'fastwp_nord_core\main', 'register_admin_scripts' ), 10 );
add_action( 'admin_enqueue_scripts', array( 'fastwp_nord_core\main', 'register_admin_styles' ), 10 );