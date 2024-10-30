<?php

global $wpdb;
    
$query = "SELECT option_name FROM $wpdb->options WHERE option_name LIKE 'lailo_%'";
$lailo_templates = $wpdb->get_col($query);

foreach($lailo_templates as $template_name) {
    delete_option($template_name);
}