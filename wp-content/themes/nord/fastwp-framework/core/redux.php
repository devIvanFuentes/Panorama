<?php

// FastWP Framework - Redux

namespace fastwp_nord_core;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class redux {

    private $sections = array();
    private $args = array();

    function __construct() {

        if( !class_exists( 'ReduxFramework' ) ) {
            return;
        }

        // Just for demo purposes. Not needed per say.
        $this->theme = wp_get_theme();

        // Set the default arguments
        $this->setArguments();


        // Create the sections and fields
        $this->getSections();

        if ( !isset( $this->args['opt_name'] ) ) { // No errors please
            return;
        }

        $this->ReduxFramework = new \ReduxFramework($this->sections, $this->args);

    }

    public function getSections() {

        $this->sections[] = array(
            'icon'      => 'el-icon-wrench',
            'title'     => esc_html__('General', 'nord'),
            'fields'    => array(
                array(
                    'id'        => 'opt-info-field',
                    'type'      => 'info',
                    'title'     => esc_html__( 'Welcome to Nord Options Panel.', 'nord' ),
                    'desc'      => esc_html__( 'It is meant to make your life easier by offering you options which will customize your website. Here you can set all general options that affects entire website.', 'nord' )
                ),
                array(
                    'id'        => 'custom_logo_text',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Logo Text', 'nord' ),
                ),
                array(
                    'id'        => 'fwp_custom_js',
                    'type'      => 'ace_editor',
                    'title'     => esc_html__( 'Custom JS', 'nord' ),
                    'subtitle'  => esc_html__( 'Paste your JavaScript code here. Use this field to quickly add JS code snippets.', 'nord' ),
                    'mode'      => 'javascript',
                    'theme'     => 'chrome',
                    'default'   => ""
                ),
                array(
                    'id'        => 'fwp_gmap_key',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Google Maps API Key', 'nord' ),
                    'subtitle'  => __( '<a href="https://www.youtube.com/watch?v=-UCHsqxBqwY" target="_blank">How to generate your api key ?</a>', 'nord' ),
                )
            )
        );

        $this->sections[] = array(
            'icon'      => 'el el-fast-forward',
            'title'     => esc_html__( 'Preloader Options', 'nord' ),
            'fields'    => array(
                array(
                    'id'        => 'show_preloader',
                    'type'      => 'switch',
                    'title'     => esc_html__( 'Show preloader', 'nord' ),
                    'subtitle'  => esc_html__( 'Enable/Disable preloader.', 'nord' ),
                    'default'   => 1,
                    'on'        => 'Enabled',
                    'off'       => 'Disabled'
                ),
            )

        );

        $this->sections[] = array(
            'icon'      => 'el-icon-gallery',
            'title'     => esc_html__('Portfolio', 'nord'),
            'fields'    => array(
                array(
                    'id'        => 'fwp_portfolio_slug',
                    'type'      => 'text',
                    'default'   => 'fwp_portfolio',
                    'title'     => esc_html__( 'Portfolio Slug', 'nord' )
                )
            )
        );

        $this->sections[] = array(
            'icon'      => 'el-icon-th-list',
            'title'     => esc_html__( 'Blog', 'nord' ),
            'fields'    => array(
                array(
                    'id'        => 'fwp_blog_title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Blog Title', 'nord' )
                ),
        		array(
        			'id'        => 'fwp_blog_minititle',
        			'type'      => 'text',
        			'title'     => esc_html__( 'Blog Mini Title', 'nord' )
        		),
                array(
                    'id'        => 'fwp_blog_sidebar',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Sidebar', 'nord' ),
                    'options'   => array(
                                        ''          => esc_html__( 'No Sidebar', 'nord' ),
                                        'left'      => esc_html__( 'Left', 'nord' ),
                                        'right'     => esc_html__( 'Right', 'nord' )
                                        )
                ),
                array(
                    'id'        => 'fwp_blog_type',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Posts Layout', 'nord' ),
                    'options'   => array(
                                        ''          => esc_html__( 'Default', 'nord' ),
                                        'minimal'   => esc_html__( 'Minimal', 'nord' )
                                        ),
                    'required'  => array('fwp_blog_sidebar', '=', '')
                ),
                array(
                    'id'        => 'fwp_blog_date_meta',
                    'type'      => 'switch',
                    'title'     => esc_html__( 'Hide Date Info', 'nord' ),
                    'subtitle'  => esc_html__( 'Shows or hides the date information on single.', 'nord' ),
                    'on'        => 'Yes',
                    'off'       => 'No',
                    'default'   => false,
                ),
            )
        );

        $this->sections[] = array(
            'icon'      => 'el-icon-inbox',
            'title'     => esc_html__('Footer', 'nord'),
            'fields'    => array(
                array(
                    'id'        => 'footer_copy',
                    'type'      => 'textarea',
                    'title'     => esc_html__( 'Footer Text', 'nord' ),
                    'desc'      => esc_html__( 'Copyright text', 'nord' )
                ),
                array(
                    'id'        => 'footer_links',
                    'type'      => 'multi_text',
                    'title'     => esc_html__( 'Footer Icons', 'nord' ),
                    'desc'      => esc_html__( 'Icon | URL (example: fa fa-facebook | https://mywebsite.ext)', 'nord' )
                ),
            )
        );

    }

    public static function getMetaboxes( $metaboxes ) {

        $portfolio_meta = array( array(
            'icon'          => 'el-icon-screen',
            'icon_class'    => 'icon_large',
            'title'         => esc_html__( 'General', 'nord' ),
            'fields'        => array(
                array(
                    'id'        => 'portfolio_image_width',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Image Width', 'nord' ),
                    'options'   => array(
                                        ''      => esc_html__( 'Default', 'nord' ),
                                        'w2'    => esc_html__( 'Wide', 'nord' ),
                                        'fw'    => esc_html__( 'Full width', 'nord' )
                                        )
                ),
                array(
                    'id'        => 'portfolio_image_height',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Image Height', 'nord' ),
                    'options'   => array(
                                        ''      => esc_html__( 'Default', 'nord' ),
                                        'h2'    => esc_html__( 'Tall', 'nord' ),
                                        'fh'    => esc_html__( 'Full height', 'nord' )
                                        )
                ),
                array(
                    'id'        => 'portfolio_template',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Template', 'nord' ),
                    'options'   => array(
                                        'default'   => esc_html__( 'Right Gallery', 'nord' ),
                                        2           => esc_html__( 'Left Gallery', 'nord' ),
                                        3           => esc_html__( 'Top Gallery', 'nord' ),
                                        4           => esc_html__( 'Bottom Gallery', 'nord' ),
                                        5           => esc_html__( 'Gallery', 'nord' )
                                        )
                ),
            )
        ) );

        $portfolio_meta[] = array(
            'icon'          => 'el-icon-gallery',
            'icon_class'    => 'icon_large',
            'title'         => esc_html__( 'Gallery & Info', 'nord' ),
            'fields'        => array(
        		array(
        			'id'        => 'project_client',
        			'type'      => 'text',
        			'title'     => esc_html__( 'Client', 'nord' )
        		),
        		array(
        			'id'        => 'project_date',
        			'type'      => 'text',
        			'title'     => esc_html__( 'Date', 'nord' )
        		),
        		array(
        			'id'        => 'project_role',
        			'type'      => 'text',
        			'title'     => esc_html__( 'Role', 'nord' )
        		),
        		array(
        			'id'        => 'project_author_url',
        			'type'      => 'text',
        			'title'     => esc_html__( 'Author Website', 'nord' )
        		),
        		array(
        			'id'        => 'project_gallery',
        			'type'      => 'slides',
        			'title'     => esc_html__( 'Gallery', 'nord' ),
        			'subtitle'  => esc_html__( 'Upload images or add from media library.', 'nord' ),
        			'placeholder'=> array(
        			                    'title' => esc_html__( 'Title', 'nord' ),
        		                    ),
        			'show' => array(
        				'title' => true,
                        'description' => false,
        				'url' => false,
        			)
                ),
            )
        );

    	$portfolio_template = array();

        if( class_exists( '\fastwp_nord_shortcodes\Portfolio' ) ) {

            $portfolio_template[] = array(
            	'icon' => 'el-icon-screen',
            	'fields' => array(
            		array(
            			'id'        => 'portfolio_title',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Page Title', 'nord' )
            		),
            		array(
            			'id'        => 'portfolio_subtitle',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Page Subtitle', 'nord' )
            		),
            		array(
            			'id'        => 'portfolio_items',
            			'type'      => 'checkbox',
            			'title'     => esc_html__( 'Display these projects', 'nord' ),
            			'subtitle'  => esc_html__( 'If no projects checked, all will be included', 'nord' ),
            			'options'   => \fastwp_nord_shortcodes\Portfolio::all_posts()
            		),
            		array(
            			'id'        => 'portfolio_items_by_id',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Or include projects by id', 'nord' ),
            			'subtitle'  => esc_html__( 'This option will override the previous option if is not empty', 'nord' )
            		),
            		array(
            			'id'        => 'portfolio_items_per_row',
            			'type'      => 'select',
            			'title'     => esc_html__( 'Items Per Row', 'nord' ),
    					'options'   => array(
        										2 => esc_html__( '2', 'nord' ),
        										3 => esc_html__( '3', 'nord' ),
        										4 => esc_html__( '4', 'nord' )
                                            ),
            		),
            		array(
            			'id'        => 'portfolio_style',
            			'type'      => 'select',
            			'title'     => esc_html__( 'Style', 'nord' ),
    					'options'   => array(
    										'masonry'   => esc_html__( 'Masonry', 'nord' ),
    										'metro'     => esc_html__( 'Metro Style', 'nord' ),
    										'grid'      => esc_html__( 'Grid Style', 'nord' ),
    										'gallery'   => esc_html__( 'Gallery/Lightbox Style', 'nord' ),
                                            ),
            		),
            		array(
            			'id'        => 'portfolio_margin',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Margin', 'nord' )
            		)
            	)
            );

        }

        $portfolio_contact = array( array(
            	'icon' => 'el-icon-screen',
            	'fields' => array(
            		array(
            			'id'        => 'contact_title',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Page Title', 'nord' )
            		),
            		array(
            			'id'        => 'contact_subtitle',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Page Subtitle', 'nord' )
            		),
            		array(
            			'id'        => 'contact_form',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Form Shortcode', 'nord' )
            		),
            		array(
            			'id'        => 'map_coordinates',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Map Coordinates', 'nord' )
            		),
            		array(
            			'id'        => 'map_center',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Map Center', 'nord' )
            		),
            		array(
            			'id'        => 'marker_title',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Marker Title', 'nord' )
            		),
            		array(
            			'id'        => 'marker_content',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Marker Content', 'nord' )
            		),
                )
            )
        );

        $portfolio_about = array( array(
            	'icon' => 'el-icon-screen',
            	'fields' => array(
            		array(
            			'id'        => 'about_title',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Page Title', 'nord' )
            		),
            		array(
            			'id'        => 'about_subtitle',
            			'type'      => 'text',
            			'title'     => esc_html__( 'Page Subtitle', 'nord' )
            		),
            		array(
            			'id'        => 'about_contenttitle',
            			'type'      => 'textarea',
            			'title'     => esc_html__( 'Content Title (left side of content)', 'nord' )
            		),
                )
            )
        );

        // Declare metaboxes

        $metaboxes[] = array(
            'id'            => 'sidebar',
            'title'         => esc_html__( 'Nord Options', 'nord' ),
            'post_types'    => array( 'fwp_portfolio' ),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $portfolio_meta,
        );

        $metaboxes[] = array(
		    'id'            => 'contact-post-options',
            'title'         => esc_html__( 'Options', 'nord' ),
            'post_types'    => array( 'page' ),
            'page_template' => array( 'template-contact.php' ),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $portfolio_contact
        );

        $metaboxes[] = array(
		    'id'            => 'about-post-options',
            'title'         => esc_html__( 'Options', 'nord' ),
            'post_types'    => array( 'page' ),
            'page_template' => array( 'template-about.php' ),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $portfolio_about
        );

        $metaboxes[] = array(
		    'id'            => 'portfolio-post-options',
            'title'         => esc_html__( 'Options', 'nord' ),
            'post_types'    => array( 'page' ),
            'page_template' => array( 'template-portfolio.php' ),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => $portfolio_template
        );

        return $metaboxes;
    }

    public function setArguments() {

        $theme = wp_get_theme(); // For use with some settings. Not necessary.

        $this->args = array(
            // TYPICAL -> Change these values as you need/desire
            'opt_name'          => 'fastwp_nord_data',            // This is where your data is stored in the database and also becomes your global variable name.
            'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
            'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
            'menu_type'         => 'submenu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
            'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
            'menu_title'        => esc_html__('Theme Options', 'nord'),
            'page_title'        => esc_html__('Theme Options', 'nord'),

            // You will need to generate a Google API key to use this feature.
            // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
            'google_api_key' => 'AIzaSyBPVwg6CaFLmKlxYjQu0bJGpxDN1p04S-Q', // Must be defined to add google fonts to the typography module

            'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
            'admin_bar'         => true,                    // Show the panel pages on the admin bar
            'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
            'dev_mode'          => false,                    // Show the time the page took to load, etc
            'customizer'        => true,                    // Enable basic customizer support

            // OPTIONAL -> Give you extra features
            'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
            'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
            'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
            'menu_icon'         => '',                      // Specify a custom URL to an icon
            'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
            'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
            'page_slug'         => '_options',              // Page slug used to denote the panel
            'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
            'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
            'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *

            // CAREFUL -> These options are for advanced use only
            'transient_time'    => 60 * MINUTE_IN_SECONDS,
            'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
            'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
            // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
            'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
            'show_import_export'    => true, // REMOVE
            'system_info'           => false, // REMOVE

            // HINTS
            'hints' => array(
                'icon'          => 'icon-question-sign',
                'icon_position' => 'right',
                'icon_color'    => 'lightgray',
                'icon_size'     => 'normal',
                'tip_style'     => array( 'color' => 'light', 'shadow' => true, 'rounded' => false, 'style' => '' ),
                'tip_position'  => array( 'my' => 'top left',  'at' => 'bottom right' ),
                'tip_effect'    => array(
                    'show'      => array( 'effect' => 'slide', 'duration' => '500', 'event' => 'mouseover' ),
                    'hide'      => array( 'effect' => 'slide', 'duration'  => '500', 'event' => 'click mouseleave' ),
                ),
            )
        );

        // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
        $this->args['share_icons'][] = array(
            'url'   => 'http://twitter.com/fastwp',
            'title' => 'Follow FastWP on Twitter',
            'icon'  => 'el-icon-twitter'
        );
        $this->args['share_icons'][] = array(
            'url'   => 'http://themeforest.net/user/fastwp/portfolio',
            'title' => 'Fastwp Official Page',
            'icon'  => 'el-icon-link'
        );
        $this->args['share_icons'][] = array(
            'url'   => 'mailto:themes@fastwp.net',
            'title' => 'Send an email to fastwp',
            'icon'  => 'el-icon-envelope'
        );

    }

    public static function demo_load( $demo_active_import , $demo_directory_path ) {

        reset( $demo_active_import );
        $current_key = key( $demo_active_import );

        /* Menu import */
        $wbc_menu_array = array(
            'demo-nord' => 'Menu 1'
        );

        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && (array_key_exists($demo_active_import[$current_key]['directory'], $wbc_menu_array) || in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array )) ) {
            $top_menu = get_term_by( 'name', $wbc_menu_array[$demo_active_import[$current_key]['directory']], 'nav_menu' );

			if ( isset( $top_menu->term_id ) ) {
                set_theme_mod( 'nav_menu_locations', array(
                        'primary' => $top_menu->term_id
                    )
                );
            }
        }

        /* Homepage select */
        $wbc_home_pages = array(
            'demo-nord' => 'Home'
        );
        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
            $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
            if ( isset( $page->ID ) ) {
                update_option( 'page_on_front', $page->ID );
                update_option( 'show_on_front', 'page' );
            }
        }

        /* Blog page select */
        $wbc_home_pages = array(
            'demo-nord' => 'Blog',
        );
        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
            $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
            if ( isset( $page->ID ) ) {
                update_option( 'page_for_posts', $page->ID );
            }
        }

    }

    public static function change_demo_directory_path( $demo_directory_path ) {
        $demo_directory_path = get_template_directory() . '/demo-data/';
        return $demo_directory_path;
    }

    function filter_title( $title ) {
        return ucfirst( trim( str_replace( "-", " ", str_replace( 'demo', '', $title ) ) ) );
    }

}

// Init filters & actions

add_action( 'redux/metaboxes/fastwp_nord_data/boxes', array( 'fastwp_nord_core\redux', 'getMetaboxes' ) );
add_action( 'wbc_importer_after_content_import', array( 'fastwp_nord_core\redux', 'demo_load' ), 10, 2 );
add_action( 'wbc_importer_after_content_import', array( 'fastwp_nord_core\redux', 'change_demo_directory_path' ), 10, 2 );
add_action( 'wbc_importer_after_content_import', array( 'fastwp_nord_core\redux', 'filter_title' ), 10, 2 );