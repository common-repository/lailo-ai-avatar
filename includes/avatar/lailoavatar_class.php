<?php
/**
 * Adds Lailo-Avatar widget.
 */
class Lailo_Avatar {
	
	/**
	 * Register widget with WordPress.
	 */
	function __construct($lailo_init_options = array()) {

		// Add Widget CDN
		wp_register_script('lailo-widget-cdn', 'https://cdn.lorent-online.net/lailo/ai-avatar/libs/'.$lailo_init_options["api_version"].'/widgets.js');
		wp_enqueue_script('lailo-widget-cdn');
		// Add main JS
		wp_enqueue_script('lailo-main-script', LAILO_AI_ROOT_DIR.'/js/main.js');
		
		$button_texts = array(
			'opened' => $lailo_init_options['button_text_opened'],
			'closed' => $lailo_init_options['button_text_closed']
		);

		$privacy_texts = array(
			'title' => $lailo_init_options['privacy_container_title'],
			'description' => $lailo_init_options['privacy_container_description'],
			'checkBoxLabel' => $lailo_init_options['privacy_checkbox_label'],
			'buttonLabel' => $lailo_init_options['privacy_submit_button_label'],
		);

		$color_settings = array(
			'primary' => $lailo_init_options['primary_color'],
			'secondary' => $lailo_init_options['secondary_color'],
			'primaryText' => $lailo_init_options['primary_text_color'],
			'secondaryText' => $lailo_init_options['secondary_text_color'],
			'inputFieldText' => $lailo_init_options['input_field_text_color'],
			'inputFieldBackground' => $lailo_init_options['input_field_bg_color'],
			'background' => $lailo_init_options['background_color']
		);

		$botSettings = array(
			'botSecret' => $lailo_init_options['bot_secret'],
			'apiVersion' => $lailo_init_options['api_version'],
			'language' => $lailo_init_options['language'],
			'widgetType' => $lailo_init_options['widget_type'],
			'colorSettings' => $color_settings,
			'exampleQuestions' => $lailo_init_options['example_questions'],
			'inputPlaceholder' => $lailo_init_options['input_placeholder'],
			'title' => $lailo_init_options['title'],
			'buttonTexts' => $button_texts,
			'usePrivacyConsent' => $lailo_init_options['use_privacy_consent'],
			'privacyTexts' => $privacy_texts,
			"openLinksInNewTab" => $lailo_init_options["open_links_in_new_tab"]
		);

		// Pass the settings object to javascript
		wp_localize_script( 'lailo-main-script', 'botSettings', $botSettings);
	}
} // class Lailo_Avatar
