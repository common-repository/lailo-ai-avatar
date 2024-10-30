<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Lailo_Template_Table extends WP_List_Table {

	/** Class constructor */
	public function __construct() {

		parent::__construct( [
			'singular' => __( 'Lailo', 'sp' ), //singular name of the listed records
			'plural'   => __( 'Lailo', 'sp' ), //plural name of the listed records
			'ajax'     => false //does this table support ajax?
		] );
	}

	/**
	 * Retrieve data from the options.
	 *
	 * @param int $per_page
	 * @param int $page_number
	 *
	 * @return mixed
	 */
	public static function get_lailo_bots() {
		global $wpdb;
        
		$query = "SELECT option_name FROM $wpdb->options WHERE option_name LIKE 'lailo_%'";
        $lailo_templates = $wpdb->get_col($query);
		
		$table_content = array();
		foreach($lailo_templates as $template_name) {
			$option = get_option($template_name);	
			array_push($table_content, array(
				'name' => $option['shortcode_name'],
				'shortcode_id' => $option['shortcode_id'],
                'colors' => array(
					'primary_color' => $option['primary_color'],
					'secondary_color' => $option['secondary_color'],
					'primary_text_color' => $option['primary_text_color'],
					'secondary_text_color' => $option['secondary_text_color'],
					'input_field_text_color' => $option['input_field_text_color'],
					'input_field_bg_color' => $option['input_field_bg_color'],
					'background_color' => $option['background_color']
				),
				'language' => $option['language'],
				'language_full' => $option['language_full'],
				'widget_type' => $option['widget_type'],
				'widget_type_fullname' => $option['widget_type_fullname'] ,
				'shortcode' => '[lailo id="' . $template_name .'"]'));
		}

		return $table_content;
	}


	/**
	 * Delete a customer record.
	 *
	 * @param int $id customer ID
	 */
	public static function delete_template( $bot_name ) {
		$option = get_option($bot_name);
		
		if ($option == false) {
			return;
		}
		
		delete_option($bot_name);
		return;
	}


	/** Text displayed when no customer data is available */
	public function no_items() {
		_e( 'No Avatars registered yet. Click on the New Lailo - AI Avatar Configuration button above to create a new template!', 'sp' );
	}


	/**
	 * Render a column when no column specific method exist.
	 *
	 * @param array $item
	 * @param string $column_name
	 *
	 * @return mixed
	 */
	public function column_default( $item, $column_name ) {

		
		switch ( $column_name ) {
			case 'shortcode':
				return $item[ $column_name ];
			case 'widget_type':
				return $item['widget_type_fullname'];
			case 'language':
				return $item['language_full'];
			case 'colors':

				$primary = $item['colors']['primary_color'];
				$secondary = $item['colors']['secondary_color'];
				$primary_text = $item['colors']['primary_text_color'];
				$secondary_text = $item['colors']['secondary_text_color'];
				$inputBg = $item['colors']['input_field_bg_color'];
				$input_text_color = $item['colors']['input_field_text_color'];
				$background_color = $item['colors']['background_color'];

				$colors_col = "
						<div style='display: flex; align-items: flex-start; justify-content: space-evenly;'>
							<span title='Primary Color' style='font-weight: bold; height: 20px; width: 20px; border-radius: 50%; background: $primary'></span>
							<span title='Secondary Color' style='font-weight: bold; height: 20px; width: 20px; border-radius: 50%; background: $secondary'></span>
							<span title='Primary Text Color' style='font-weight: bold; height: 20px; width: 20px; border-radius: 50%; background: $primary_text'></span>
							<span title='Secondary Text Color' style='font-weight: bold; height: 20px; width: 20px; border-radius: 50%; background: $secondary_text'></span>
							<span title='Sidebar Bg Color' style='font-weight: bold; height: 20px; width: 20px; border-radius: 50%; background: $background_color'></span>
							<span title='Input Text Color' style='font-weight: bold; height: 20px; width: 20px; border-radius: 50%; background: $input_text_color'></span>
							<span title='Input Background Color' style='font-weight: bold; height: 20px; width: 20px; border-radius: 50%; background: $inputBg'></span>
						</div>
				";
				return print_r($colors_col, true);
			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

	/**
	 * Method for name column
	 *
	 * @param array $item an array of DB data
	 *
	 * @return string
	 * 
	 */
	function column_name( $item ) {

		// $delete_nonce = wp_create_nonce( 'sp_delete_lailo_bot' );

		$title = '<strong>' . $item['name'] . '</strong>';
		$shortcode_id = $item['shortcode_id'];
		$editUrl = esc_url(admin_url('admin.php').'?page=lailo_avatar_settings_page&selected_template='.$shortcode_id);
		$duplicateUrl = esc_url(admin_url('admin.php').'?page=lailo_template_table&action=duplicate&bot='.$shortcode_id);

		$actions = [
			// 'delete' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['name'], $delete_nonce )
			'delete' => sprintf( "<a class='delete-template-btn' data-shortcode-id=$shortcode_id>Delete</a>"),
			'edit' => sprintf( "<a href=$editUrl>Edit</a>", $_REQUEST['page'], 'edit', $item['name'] ),
			'duplicate' => sprintf( "<a href=$duplicateUrl>Duplicate</a>", $_REQUEST['page'], 'edit', $item['name'] )
		];

		return $title . $this->row_actions( $actions );
	}


	/**
	 *  Associative array of columns
	 *
	 * @return array
	 */
	function get_columns() {
		$columns = [
			'name'    => __( 'Name', 'sp' ),
			'widget_type' => __( 'Widget Type', 'sp' ),
			'language' => __('Language', 'sp'),
			'colors' => __('Color Scheme', 'sp'),
			'shortcode'    => __( 'Shortcode', 'sp' )
		];

		return $columns;
	}


	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			// 'name' => array( 'name', false ),
		);

		return $sortable_columns;
	}

	/**
	 * Handles data query and filter, sorting, and pagination.
	 */
	public function prepare_items() {

		$this->_column_headers = $this->get_column_info();
		$this->process_actions();
        $this->items = self::get_lailo_bots();
	}

	public function process_actions() {

		//Detect when a bulk action is being triggered...
		if ( 'delete' === $this->current_action() ) {
			self::delete_template(  sanitize_text_field($_GET['bot'])  );
		}

		if ( 'duplicate' === $this->current_action() ){
			$bot_shortcode_id = sanitize_text_field($_GET['bot']);
			$template = get_option( $bot_shortcode_id );
			
			$new_name = $template['shortcode_name'].' Duplicate';
			$new_shortcode_id = $bot_shortcode_id.'_duplicate';
			$duplicated_template = array(
				'shortcode_name' => $new_name,
				'shortcode_id' => $new_shortcode_id,
				'bot_secret' => $template['bot_secret'],
				'api_version' => $template['api_version'],
				'language' => $template['language'],
				'language_full' => $template['language_full'],
				'widget_type' => $template['widget_type'],
				'widget_type_fullname' => $template['widget_type_fullname'],
				'primary_color' => $template['primary_color'],
				'secondary_color' => $template['secondary_color'],
				'primary_text_color' => $template['primary_text_color'],
				'secondary_text_color' => $template['secondary_text_color'],
				'input_field_text_color' => $template['input_field_text_color'],
				'input_field_bg_color' => $template['input_field_bg_color'],
				'background_color' => $template['background_color'],
				'example_questions' => $template['example_questions'],
				'title' => $template['title'],
				'button_text_opened' => $template['button_text_opened'],
				'button_text_closed' => $template['button_text_closed'],
				'input_placeholder' => $template['input_placeholder'],
				'use_privacy_consent' => $template['use_privacy_consent'],
				"privacy_container_title" => $template['privacy_container_title'],
				"privacy_container_description" => $template['privacy_container_description'],
				"privacy_checkbox_label" => $template['privacy_checkbox_label'],
				"privacy_submit_button_label" => $template['privacy_submit_button_label'],
				"open_links_in_new_tab" => $template["open_links_in_new_tab"]
			);
			
			add_option($new_shortcode_id, $duplicated_template);
		}
	}

}