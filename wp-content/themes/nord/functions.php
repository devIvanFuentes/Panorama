<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
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

require_once FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/autoload.php';

/*** General ***/

if ( ! isset( $content_width ) ) $content_width = 900;
if ( is_singular() ) wp_enqueue_script( "comment-reply" );

/*** Redux framework ***/

new fastwp_nord_core\redux;

// Theme support

fastwp_nord_core\general::add_theme_support( 'menus,custom-logo,title-tag,post-thumbnails,automatic-feed-links' );
fastwp_nord_core\general::add_theme_support( 'post-formats',
    array(
        'image'
    )
);

add_action( 'init', array( 'fastwp_nord_core\general', 'register_theme_support' ), 1 );

// Add menu location

fastwp_nord_core\menu::add_menu( 'primary', esc_html__( 'Main menu', 'nord' ) );

// Language dir used for translation

fastwp_nord_core\general::text_domain_language_dir( 'nord' );

/*** List of the styles used in Nord Theme ***/

fastwp_nord_core\main::add_styles( FASTWP_NORD_URI . '/assets/css',
    array(
        'fontawesome',
        'magnific-popup',
        'main',
        'wp',
        'admin'
    )
);

fastwp_nord_core\main::add_styles( 'https://fonts.googleapis.com/css?family=',
    array(
        'Roboto:300,400,500'
    ),
    true,
    'google-fonts'
);

fastwp_nord_core\main::add_admin_styles( FASTWP_NORD_URI . '/assets/css',
    array(
        'admin'
    )
);

/*** List of the javascript files used in Nord Theme ***/

fastwp_nord_core\main::add_scripts( FASTWP_NORD_URI  . '/assets/js',
    array(
        'main',
        'Isotope',
        'waitForImages',
        'SmoothScroll',
        'MagnificPopup'
    )
);

fastwp_nord_core\main::add_script_deps( 'main', array( 'jquery' ) );

if( fastwp_nord_theme\utils::get_option( 'fwp_gmap_key' ) !== '' ) {
    fastwp_nord_core\main::add_scripts( FASTWP_NORD_URI  . '/assets/js',
        array(
            'custom'
        )
    );

    fastwp_nord_core\main::add_scripts( '//maps.googleapis.com/maps/api/js?key=' . fastwp_nord_theme\utils::get_option( 'fwp_gmap_key' ) );
}


/*** List of required plugins ***/

fastwp_nord_core\tgmpa::add_plugin( 'contact-form-7',
    array(
        'name'      => 'Contact form 7',
        'required'  => false
    )
);

fastwp_nord_core\tgmpa::add_plugin( 'functionality-for-nord-theme',
    array(
        'name'      => 'Nord Theme Functionality',
        'source'    => FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/plugins/functionality-for-nord-theme.zip',
        'required'  => false
    )
);

fastwp_nord_core\tgmpa::add_plugin( 'fastwp-redux-nord-extension',
    array(
        'name'      => 'Redux Theme Options for Nord Theme',
        'source'    => FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/plugins/fastwp-redux-nord-extension.zip',
        'required'  => false
    )
);

/*** Add widget areas ***/

fastwp_nord_core\main::add_widget_area( 'sidebar-1', esc_html__( 'Nord Widgets', 'nord' ),
    array(
        'description'   => esc_html__( 'Widgets used in Nord theme', 'nord' ),
    )
);

/*** Init custom filters ***/

new fastwp_nord_theme\filters;


/*** Customizer ***/

add_action( 'customize_register', array( 'fastwp_nord_customizer\customizer', 'register' ), 1 );

?>
