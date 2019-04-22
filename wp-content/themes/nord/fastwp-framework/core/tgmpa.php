<?php

// FastWP Framework - TGMPA

namespace fastwp_nord_core;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct script access denied.' );
}

class tgmpa {

    private static $plugins = array();

    /* Manage plugins */

    public static function add_plugin( $slug = '', $args = array() ) {
        if( !empty( $slug ) && !empty( $args['name'] ) ) {
        self::$plugins[$slug] = array_merge( array(
            'name'			    => $args['name'], // The plugin name
            'slug'			    => $slug, // The plugin slug (typically the folder name)
            //'source'			=> ( isset( $args['source'] ) ? $args['source'] : '' ), // The plugin source
            'required'			=> true, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'	=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
            ),
            $args );
        }
    }

    public static function modify_plugin( $slug = '', $args = array() ) {
        if( isset( self::$plugins[$slug] ) ) {
            self::$plugins[$slug] = array_merge( self::$plugins[$slug], $args );
        }
    }

    public static function remove_plugin( $slug = '' ) {
        if( isset( self::$plugins[$slug] ) ) {
            unset( self::$plugins[$slug] );
        }
    }

    public static function list_of_plugins() {
        return self::$plugins;
    }

    public static function config() {
        return array(
		'id'           => 'nord',                // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                       // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',  // Menu slug.
		'parent_slug'  => 'themes.php',             // Parent menu slug.
		'capability'   => 'edit_theme_options',     // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                     // Show admin notices or not.
		'dismissable'  => true,                     // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                    // Automatically activate plugins after installation or not.
		'message'      => '',                       // Message to output right before the plugins table.

		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'nord' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'nord' ),

			/* translators: %s: plugin name. */
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'nord' ),
			/* translators: %s: plugin name. */
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'nord' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'nord' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'nord'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'nord'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'nord'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). */
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'nord'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'nord'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'nord'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'nord'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'nord'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'nord'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'nord' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'nord' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'nord' ),
			/* translators: 1: plugin name. */
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'nord' ),
			/* translators: 1: plugin name. */
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'nord' ),
			/* translators: 1: dashboard link. */
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'nord' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'nord' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'nord' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'nord' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),

	    );
    }

    public static function setup() {
        require_once FASTWP_NORD_DIR . '/' . FASTWP_NORD_FRAMEWORK_DIR . '/libs/class-tgm-plugin-activation.php';

        if( function_exists( 'tgmpa' ) && ( $plugins = self::list_of_plugins() ) && !empty( $plugins ) ) {
            tgmpa( $plugins, self::config() );
        }
    }

}

// Init filters & actions

add_action( 'init', array( 'fastwp_nord_core\tgmpa', 'setup' ), 1 );
add_action( 'tgmpa_register', array( 'fastwp_nord_core\tgmpa', 'setup' ) );