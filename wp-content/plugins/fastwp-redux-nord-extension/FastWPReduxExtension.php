<?php

/*
Plugin Name: FastWP Redux extension for Nord Theme
Plugin URI: http://fastwp.net
Description: FastWP Theme extension for fastwp themes. This plugin is required to initialize custom posts, custom taxonomies and theme shortcodes
Author: FastWP
Version: 1.0
Author URI: http://fastwp.net
*/

require_once ABSPATH .'wp-includes/pluggable.php';
require_once plugin_dir_path( __FILE__ )  . 'ReduxCore/framework.php';   
require_once plugin_dir_path( __FILE__ )  . 'ReduxCore/loader.php';