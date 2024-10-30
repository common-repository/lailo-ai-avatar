<?php
/*
Plugin Name: Lailo - AI Avatar
Plugin URI: https://www.lailo.ai
Description: Lailo - AI Avatar WordPress Plugin
Version: 1.4.2
Author: Lorent IT-Lösungen GmbH
*/

// Preventing direct access
if(!defined("ABSPATH")){
    exit;
}

define( 'LAILO_AI_ROOT_DIR', plugin_dir_url( __FILE__ ) );

function add_lailo_ai_avatar_query_vars_filter( $vars ) {
	$vars[] = "selected_template";
	return $vars;
  }
add_filter( 'query_vars', 'add_lailo_ai_avatar_query_vars_filter' );

function remove_footer_admin () {
  echo 'Thank you for using our Lailo AI Avatar Plugin!';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Initialize shortcode and widget
require_once(plugin_dir_path(__FILE__).'/includes/lailo_init.php');

// Load admin page
require_once(plugin_dir_path(__FILE__).'/includes/lailo_admin.php');