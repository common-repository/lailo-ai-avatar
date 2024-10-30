<?php

add_action('wp_ajax_lailo_update_bot_options', 'lailo_update_bot_options');
function lailo_update_bot_options()
{

    $guid_regex = '/^\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/';

    if (
        !sanitize_text_field($_POST['shortcode_name']) ||
        !$_POST['bot_secret'] ||
        !preg_match($guid_regex, $_POST['bot_secret'])
    ) {
        wp_redirect(admin_url('admin.php') . "?page=lailo_avatar_error_page");
        exit;
    }

    // Removing non-word characters except for spaces from the user input and sanitizing the result
    $name_clean = preg_replace('/[^\w ]/', '', $_POST['shortcode_name']);
    $name_sanitized = sanitize_text_field($name_clean);

    // Creating the shortcode_id by removing all whitespaces and replacing them with underscrores. Also adding the lailo_ prefix.
    $shortcode_id = 'lailo_' . strtolower(preg_replace('/\s+/', '_', $name_sanitized));

    $languages_per_code = array(
        "de-DE" => "Deutsch",
        "en-US" => "English",
        "fr-FR" => "Français"
    );

    $widget_type_fullname = array(
        "tinyWidget" => "Tiny Widget",
        "halfScreenWidget" => "Half Screen Widget",
        "fullScreenWidget" => "Full Screen Widget",
    );

    $old_shortcode_id_sanitized = sanitize_text_field($_POST['old_shortcode_id']);

    $language_sanitized = sanitize_text_field($_POST["language"]);
    $bot_secret_sanitized = sanitize_text_field($_POST["bot_secret"]);
    $widget_type_sanitized = sanitize_text_field($_POST["widget_type"]);
    $api_version_sanitized = sanitize_text_field($_POST["api_version"]);
    $primary_color_sanitized = sanitize_hex_color($_POST["primary_color"]);
    $secondary_color_sanitized = sanitize_hex_color($_POST["secondary_color"]);
    $primary_text_color_sanitized = sanitize_hex_color($_POST["primary_text_color"]);
    $secondary_text_color_sanitized = sanitize_hex_color($_POST["secondary_text_color"]);
    $input_field_bg_color_sanitized = sanitize_hex_color($_POST["input_field_bg_color"]);
    $input_field_text_color_sanitized = sanitize_hex_color($_POST["input_field_text_color"]);
    $background_color_sanitized = sanitize_hex_color($_POST["background_color"]);

    $title_sanitized = sanitize_text_field($_POST["title"]);
    $button_text_opened_sanitized = sanitize_text_field($_POST["button_text_opened"]);
    $button_text_closed_sanitized = sanitize_text_field($_POST["button_text_closed"]);
    $input_placeholder_sanitized = sanitize_text_field($_POST["input_placeholder"]);

    $privacy_container_title_sanitized = sanitize_text_field($_POST["privacy_container_title"]);
    $privacy_container_description_sanitized = wp_kses( $_POST["privacy_container_description"], array(
		'p' => array(),
        'a' => array(
            'href' => array(),
            'title' => array(),
            'target' => array(),
            'rel' => array(),
            'referrerpolicy' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
        'span' => array()
    ) );
    $privacy_checkbox_label_sanitized = sanitize_text_field($_POST["privacy_checkbox_label"]);
    $privacy_submit_button_label_sanitized = sanitize_text_field($_POST["privacy_submit_button_label"]);

    $example_questions_sanitized = null;

    if ($_POST['example_questions']) {
        $example_questions_sanitized = array();
        foreach ($_POST["example_questions"] as $question) {
            array_push($example_questions_sanitized, sanitize_text_field($question));
        }
    }

    $avatar = array(
        "shortcode_name" => $name_sanitized,
        "shortcode_id" => $shortcode_id,
        "bot_secret" => $bot_secret_sanitized,
        "api_version" => $api_version_sanitized,
        "language" => $language_sanitized,
        "language_full" => $languages_per_code[$language_sanitized],
        "widget_type" => $widget_type_sanitized,
        "widget_type_fullname" => $widget_type_fullname[$widget_type_sanitized],
        "primary_color" => ($primary_color_sanitized ? $primary_color_sanitized : '#f8b816'),
        "secondary_color" => ($secondary_color_sanitized ? $secondary_color_sanitized : '#dfa107'),
        "primary_text_color" => ($primary_text_color_sanitized ? $primary_text_color_sanitized : '#1C1C1C'),
        "secondary_text_color" => ($secondary_text_color_sanitized ? $secondary_text_color_sanitized : '#454545'),
        "input_field_text_color" => ($input_field_text_color_sanitized ? $input_field_text_color_sanitized : '#1C1C1C'),
        "input_field_bg_color" => ($input_field_bg_color_sanitized ? $input_field_bg_color_sanitized : '#d7c922'),
        "background_color" => ($background_color_sanitized ? $background_color_sanitized : '#ffffff'),
        "example_questions" => $example_questions_sanitized,
        "title" => $title_sanitized,
        "button_text_opened" => $button_text_opened_sanitized,
        "button_text_closed" => $button_text_closed_sanitized,
        "input_placeholder" => $input_placeholder_sanitized,
        "use_privacy_consent" => ($_POST["use_privacy_consent"] ? true : false),
        "open_links_in_new_tab" => ($_POST["open_links_in_new_tab"] ? true : false),
        "privacy_container_title" => $privacy_container_title_sanitized,
        "privacy_container_description" => $privacy_container_description_sanitized,
        "privacy_checkbox_label" => $privacy_checkbox_label_sanitized,
        "privacy_submit_button_label" => $privacy_submit_button_label_sanitized
    );

    // If the shortcode_id stays the same the settings of that avatar will be updated.
    // If the user changes the avatars name, the edited avatar will be deleted and the new one will be added. 
    if ($old_shortcode_id_sanitized == $avatar['shortcode_id']) {
        update_option($avatar['shortcode_id'], $avatar);
    } else {
        delete_option($old_shortcode_id_sanitized);
        add_option($avatar['shortcode_id'], $avatar);
    }

    wp_redirect(admin_url('admin.php') . "?page=lailo_template_table");
    exit;
}
