<?php

require_once(plugin_dir_path(__FILE__).'/functions/lailo_update_settings.php');

require_once(plugin_dir_path(__FILE__).'/avatar/lailoavatar_class.php');

// Add Shortcode
function lailo_shortcode( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'id' => '',
		),
		$atts,
		'lailo'
    );

    $botInitObject = array();

    if( get_option($atts['id'])){
         $botInitObject = get_option($atts['id']);
		
		// Instantiate avatar class
    	new Lailo_Avatar($botInitObject);

		add_action('wp_footer', 'insert_lailo_container');

		function insert_lailo_container(){
			echo("<div id='lailo-smart-character'></div>");
		}
    }
}

add_shortcode( 'lailo', 'lailo_shortcode' );