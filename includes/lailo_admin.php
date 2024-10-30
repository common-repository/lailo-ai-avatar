<?php

require_once(plugin_dir_path(__FILE__).'/admin/lailo_admin_page.php');

add_action('plugin_loaded', function() {
	LailoAdminPage::get_instance();
});


function lailo_ai_avatar_settings_page() {
	add_submenu_page(
		'',
		__( 'Lailo Avatar', 'avatar-textdomain' ),
		__( 'Add Template', 'avatar-textdomain' ),
		'manage_options',
		'lailo_avatar_settings_page',
		'lailo_ai_avatar_settings_page_contents',
		"",
		0
	);
}

function lailo_ai_avatar_error_page() {
	add_submenu_page(
		'',
		__( 'Lailo Avatar', 'avatar-textdomain' ),
		__( 'Error', 'avatar-textdomain' ),
		'manage_options',
		'lailo_avatar_error_page',
		'lailo_ai_avatar_error_page_contents',
		"",
		0
	);
}

function lailo_ai_avatar_settings_page_contents(){
	include(plugin_dir_path(__FILE__).'/template/lailo_settings.php');
}

function lailo_ai_avatar_error_page_contents(){
	include(plugin_dir_path(__FILE__).'template/lailo_error_page.php');
}

add_action('admin_menu', 'lailo_ai_avatar_settings_page' );
add_action('admin_menu', 'lailo_ai_avatar_error_page');

