<style>
	input[type="text"]{
		width: 350px;
	}
	label {
		margin-right: .4rem;
		font-weight: bold;
	}

	.lailo-label-group{
		margin-bottom: .3rem;
	}

	.lailo-input-field{
		margin: 0 0 .3rem 0;
	}

	.lailo-settings-group{
		width: 450px;
		padding: .5rem 0;
	}
	button{
		width: 350px; 
		margin: 1rem 0;
	}
	.notice{
		padding: .3rem;
		opacity: 0;
		transition: 400ms opacity ease-in-out;
		margin: .5rem 0;
	}

	.notice-success,
	.notice-error{
		opacity: 1;
	}

	.color-picker-container{
		max-width: 400px;
		grid-gap: 1.5rem;
		padding: 1rem 0;
		display: grid;
		grid-template-columns: repeat(2, 1fr);
	}

	input[type="color"]{
		width: 100px;
	}

	#lailo-privacy-settings #lailo-privacy-text-settings {
		display: none;
	}

	#lailo-privacy-settings #use_privacy_consent {
		margin: 1rem 0;
	}

	#lailo-privacy-settings[data-show-text-settings="true"] #lailo-privacy-text-settings {
		display: block;
	}

	#advanced-settings-section{
		display: none;
		transition: 500ms all ease-in-out;
	}

	#trigger-advanced-settings{
		max-width: 200px;
		transition: all 150ms ease-out;
		font-size: 1.2rem;
	}

	#trigger-advanced-settings.advanced-show ~ #advanced-settings-section{
		display: flex;
		flex-direction: column;
	}

	#trigger-icon{
		cursor: pointer;
		transition: 150ms color ease-out;
		float: right;
		margin-left: .7rem;
	}

	#trigger-icon:hover{
		color: green;
	}

	#trigger-advanced-settings.advanced-show #trigger-icon{
		color: #00c900;
	}

	.help-icon{
		font-size: 1.3rem;
		position: relative;
		transition: color 200ms ease-in-out;
	}

	.help-text{
		padding: .4rem .7rem .7rem .7rem;
		position: absolute;
		top: -80px;
		left: 50%;
		transform: translate(-50%, 20px);
		background: #1c1c1c;
		color: whitesmoke;
		font-size: 1rem;
		min-width: 320px;
		max-width: 350px;
		border-radius: 5px;
		line-height: 1.1;
		opacity: 0;
		transition: 200ms all ease-in-out;
		pointer-events: none;
	}

	.help-text::after{
		content: '';
		position: absolute;
		left: 50%;
		bottom: -10px;
		transform: translateX(-50%);
		width: 0; 
		height: 0; 
		border-left: 10px solid transparent;
		border-right: 10px solid transparent;
		border-top: 10px solid #1c1c1c;
	}

	.help-icon:hover{
		color: #545454;
		cursor: help;
	}

	.help-icon.help-bot-secret,
	.help-icon.help-api-version{
		cursor: pointer;
	}

	.help-icon:hover .help-text{
		opacity: 1;
		transform: translate(-50%, 0);
		z-index: 10000;
		
	}

	#language-example-section{
		display: grid;
		max-width: 400px;
		grid-template-columns: repeat(3, 1fr);
		grid-gap: 5px;
	}

	.language-example-group{
		border: 1px solid black;
    	padding: 0px 12px;
	}

	.delete-typeit-row-btn{
		color: red;
		font-size: 1.1rem;
		transition: 120ms color ease-out;
		cursor: pointer;
		vertical-align: sub;
		margin-left: .3rem;
	}

	.delete-typeit-row-btn:hover{
		color: #a80000;
	}

	input[name="example_questions[]"]{
		opacity: 0;
		transform: translateY(12px);
		animation: fadeIn 150ms ease-out forwards;
	}

	.dashicons-warning{
		margin-right: .3rem;
		color: #f8b816;
	}

	#widget-type-warning{
		max-width: 360px;
	}

	#wpfooter {
		bottom: unset;
	}

	@keyframes fadeIn{
		to{
			opacity: 1;
			transform: none;
		}
	}

</style>
<h1>
	<?php esc_html_e( 'Welcome to the Lailo Avatar Admin Page.', 'lailo-avatar-textdomain' ); ?>
</h1>
<form action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" id="update-lailo-settings-form">
	<?php 
		$param = $_GET['selected_template'];
		$botSettings = get_option($param);
	?>
	<h2><?php echo esc_html( "General Settings" ); ?></h2>

	<div class="lailo-settings-group">
		<div class="lailo-label-group">
			<label for="shortcode_name"><?php echo esc_html( "Lailo AI Avatar Name" ); ?></label>
			<span class="dashicons dashicons-editor-help help-icon help-name"><span class="help-text"><?php echo esc_html( "Enter a short name for your Avatar. For example  \"About Page Avatar\""); ?></span></span>
		</div>
		<input
			required
			class="lailo-input-field"
			type="text" 
			name="shortcode_name" 
			id="shortcode_name" 
			placeholder="Insert a short name for your template"
			value="<?php echo esc_html($botSettings['shortcode_name'] != '' ? $botSettings['shortcode_name'] : ''); ?>">
	</div>

	<div class="lailo-settings-group">
		<div class="lailo-label-group">
			<label for="bot_secret"><?php echo esc_html("Bot Secret"); ?></label>
			<a href=<?php echo esc_url("https://portal.lailo.ai/"); ?> target="_blank" rel="noopener noreferrer" class="dashicons dashicons-editor-help help-icon help-bot-secret"><span class="help-text"><?php echo esc_html("You need a bot secret to activate this plugin. Visit the https://portal.lailo.ai website and look for your Bot Secret under the Settings of your Bot"); ?></span></a>
		</div>
		<input
			required
			class="lailo-input-field"
			type="text" 
			name="bot_secret" 
			id="bot_secret" 
			placeholder="Insert bot secret here..." 
			value=<?php echo esc_html($botSettings['bot_secret'] ? $botSettings['bot_secret'] : ''); ?>>
	</div>

	<div class="lailo-settings-group">
		<label for="widget_type"><?php echo esc_html("Widget Type"); ?></label>
		<select
			class="lailo-input-field"
			id='widget_type' 
			name='widget_type' 
		>
			<option value="tinyWidget" <?php echo ($botSettings['widget_type'] == 'tinyWidget' ? 'selected' : ''); ?>><?php echo esc_html("Tiny Widget"); ?></option>
			<option value="halfScreenWidget" <?php echo ($botSettings['widget_type'] == 'halfScreenWidget' ? 'selected' : ''); ?>><?php echo esc_html("Half Screen Widget"); ?></option>
			<option value="fullScreenWidget" <?php echo ($botSettings['widget_type'] == 'fullScreenWidget' ? 'selected' : ''); ?>><?php echo esc_html("Full Screen Widget"); ?></option>
		</select>
		<p id="widget-type-warning"></p>
	</div>
	<div class="lailo-settings-group">
		<label for="language"><?php echo esc_html("Language"); ?></label>
		<select
			class="lailo-input-field"
			id='language' 
			name='language' 
		>
			<option value="en-US" <?php echo ($botSettings['language'] == 'en-US' ? 'selected' : ''); ?>><?php echo esc_html("English"); ?></option>
			<option value="fr-FR" <?php echo ($botSettings['language'] == 'fr-FR' ? 'selected' : ''); ?>><?php echo esc_html("French"); ?></option>
			<option value="de-DE" <?php echo ($botSettings['language'] == 'de-DE' ? 'selected' : ''); ?>><?php echo esc_html("German"); ?></option>
		</select>
	</div>
	<div class="lailo-settings-group">
	<input
			class="lailo-input-field" 
			id='open_links_in_new_tab' 
			name='open_links_in_new_tab' 
			type='checkbox' 
			<?php echo( $botSettings['open_links_in_new_tab'] ? "checked" : "" ); ?>>
				<label for="open_links_in_new_tab" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Open URLs in a new tab"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-use-privacy-consent"><span class="help-text"><?php echo esc_html("If checked all URLs will be opened in a new tab. If left unchecked the current window will open the URL."); ?></span></span>
	</div>
	<div class="lailo-settings-group" id="lailo-privacy-settings" data-show-text-settings=<?php echo( $botSettings['use_privacy_consent'] ? "true" : "false" ); ?>>
		<input
			class="lailo-input-field" 
			id='use_privacy_consent' 
			name='use_privacy_consent' 
			type='checkbox' 
			<?php echo( $botSettings['use_privacy_consent'] ? "checked" : "" ); ?>>
				<label for="use_privacy_consent" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Ask the user to accept privacy policy"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-use-privacy-consent"><span class="help-text"><?php echo esc_html("If checked the Avatar will display a privacy container that asks the user to share his data with the Avatar."); ?></span></span>
		<div id="lailo-privacy-text-settings">
			<div class="lailo-settings-group">
				<div class="lailo-label-group">
					<label for="privacy_container_title" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Privacy Container Title"); ?></label>
					<span class="dashicons dashicons-editor-help help-icon help-use-secondary-color"><span class="help-text"><?php echo esc_html("Sets the title of the privacy container"); ?></span></span>
				</div>
				<input
					class="lailo-input-field" 
					id='privacy_container_title' 
					name='privacy_container_title' 
					type='text' 
					value="<?php echo ($botSettings['privacy_container_title'] ? $botSettings['privacy_container_title'] : ''); ?>">
			</div>
			<div class="lailo-settings-group">
				<div class="lailo-label-group">
					<label for="privacy_container_description" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Privacy Description"); ?></label>
					<span class="dashicons dashicons-editor-help help-icon help-use-secondary-color"><span class="help-text"><?php echo esc_html("Sets the description of the privacy container. You can also use HTML tags for URLs e.g. \"Visit out <a href=\"www.your-website.com/privacy\">Privacy</a> section on our page."); ?></span></span>
				</div>
				<input
					class="lailo-input-field" 
					id='privacy_container_description' 
					name='privacy_container_description' 
					type='text' 
					value="<?php echo esc_html($botSettings['privacy_container_description'] ? $botSettings['privacy_container_description'] : ''); ?>">
			</div>
			<div class="lailo-settings-group">
				<div class="lailo-label-group">
					<label for="privacy_checkbox_label" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Privacy Checkbox Label"); ?></label>
					<span class="dashicons dashicons-editor-help help-icon help-use-secondary-color"><span class="help-text"><?php echo esc_html("Sets the label that is displayed directly next to the checkbox."); ?></span></span>
				</div>
				<input
					class="lailo-input-field" 
					id='privacy_checkbox_label' 
					name='privacy_checkbox_label' 
					type='text' 
					value="<?php echo ($botSettings['privacy_checkbox_label'] ? $botSettings['privacy_checkbox_label'] : ''); ?>">
			</div>
			<div class="lailo-settings-group">
				<div class="lailo-label-group">
					<label for="privacy_submit_button_label" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Privacy Submit Label"); ?></label>
					<span class="dashicons dashicons-editor-help help-icon help-use-secondary-color"><span class="help-text"><?php echo esc_html("Sets the label of the submit button e.g. \"Accept\" or \"Consent\"."); ?></span></span>
				</div>
				<input
					class="lailo-input-field" 
					id='privacy_submit_button_label' 
					name='privacy_submit_button_label' 
					type='text' 
					value="<?php echo ($botSettings['privacy_submit_button_label'] ? $botSettings['privacy_submit_button_label'] : ''); ?>">
			</div>
		</div>
	</div>

	<hr />

	<h2><?php echo esc_html("Appearance Configuration"); ?></h2>

	<div class="color-picker-container">
		<div class="color-group">
			<div class="lailo-label-group">
				<label for="primary_color"><?php echo esc_html("Primary Color"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-primary-color"><span class="help-text"><?php echo esc_html("The primary color defines the background color of the Avatar buttons."); ?></span></span>
			</div>
			<input
				required
				type="color"
				class="lailo-input-field" 
				id='primary_color' 
				name='primary_color' 
				value="<?php echo ($botSettings['primary_color'] ? $botSettings['primary_color'] : '#f8b816'); ?>">
		</div>
		<div class="color-group">
			<div class="lailo-label-group">
				<label for="secondary_color"><?php echo esc_html("Secondary Color"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-secondary-color"><span class="help-text"><?php echo esc_html("The secondary color can be used to change the background color of the Avatar input panel."); ?></span></span>
			</div>
			<input
				required
				type="color"
				class="lailo-input-field" 
				id='secondary_color' 
				name='secondary_color' 
				value="<?php echo ($botSettings['secondary_color'] ? $botSettings['secondary_color'] : '#dfa107'); ?>">

		</div>
		<div class="color-group">
			<div class="lailo-label-group">
				<label for="background_color"><?php echo esc_html("Background Color"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-sidebar-bg-color"><span class="help-text"><?php echo esc_html("The background color of the widget and the opener button."); ?></span></span>
			</div>
			<input
				required
				type="color"
				class="lailo-input-field" 
				id='background_color' 
				name='background_color' 
				value="<?php echo ($botSettings['background_color'] ? $botSettings['background_color'] : '#ffffff'); ?>">
		</div>
		<div class="color-group">
			<div class="lailo-label-group">
				<label for="primary_text_color"><?php echo esc_html("Primary Text Color"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-text-color"><span class="help-text"><?php echo esc_html("This option defines the color of the title and answer displayed within the Avatar."); ?></span></span>
			</div>
			<input
				required
				type="color"
				class="lailo-input-field" 
				id='primary_text_color' 
				name='primary_text_color' 
				value="<?php echo ($botSettings['primary_text_color'] ? $botSettings['primary_text_color'] : '#1C1C1C'); ?>">
		</div>
		<div class="color-group">
			<div class="lailo-label-group">
				<label for="secondary_text_color"><?php echo esc_html("Secondary Text Color"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-text-color"><span class="help-text"><?php echo esc_html("This option defines the color of the example questions within the Avatar."); ?></span></span>
			</div>
			<input
				required
				type="color"
				class="lailo-input-field" 
				id='secondary_text_color' 
				name='secondary_text_color' 
				value="<?php echo ($botSettings['secondary_text_color'] ? $botSettings['secondary_text_color'] : '#454545'); ?>">
		</div>
		<div class="color-group">
			<div class="lailo-label-group">
				<label for="input_field_bg_color"><?php echo esc_html("Input Field"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-input-field-bg-color"><span class="help-text"><?php echo esc_html("This option defines the background color of the Avatar text input field."); ?></span></span>
			</div>
			<input
				required
				type="color"
				class="lailo-input-field" 
				id='input_field_bg_color' 
				name='input_field_bg_color' 
				value="<?php echo ($botSettings['input_field_bg_color'] ? $botSettings['input_field_bg_color'] : '#F5F5F5'); ?>">
		</div>
		<div class="color-group">
			<div class="lailo-label-group">
				<label for="input_field_text_color"><?php echo esc_html("Input Text Color"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-input-field-text-color"><span class="help-text"><?php echo esc_html("This option defines the text color of the Avatar input field."); ?></span></span>
			</div>
			<input
				required
				type="color"
				class="lailo-input-field" 
				id='input_field_text_color' 
				name='input_field_text_color' 
				value="<?php echo ($botSettings['input_field_text_color'] ? $botSettings['input_field_text_color'] : $botSettings['primary_text_color']); ?>">
		</div>
	</div>

	<hr />

	<div id="trigger-advanced-settings"><?php echo esc_html("Advanced Settings"); ?><span class="dashicons dashicons-insert" id="trigger-icon"></span></div>
	<br />
	<div id="advanced-settings-section">
		<div class="lailo-settings-group">
			<h4><?php echo esc_html("You can customize the titles of various elements of the Avatar. E.g. the main title which is visible when the input panel is open or the button texts depending on the open / close state of the input panel. Or even the input field placeholder! Note: if you leave a field empty a default text for the chosen language is going to be displayed."); ?></h4>
			<div class="lailo-label-group">
				<label for="title" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Main Title"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-use-secondary-color"><span class="help-text"><?php echo esc_html("Sets the main title within the user input panel."); ?></span></span>
			</div>
			<input
				class="lailo-input-field" 
				id='title' 
				name='title' 
				type='text' 
				value="<?php echo ($botSettings['title'] ? $botSettings['title'] : ''); ?>">
		</div>
		<div class="lailo-settings-group">
			<div class="lailo-label-group">
				<label for="button_text_opened" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Button - Opened"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-use-secondary-color"><span class="help-text"><?php echo esc_html("Sets the text of the button when the input panel is open."); ?></span></span>
			</div>
			<input
				class="lailo-input-field" 
				id='button_text_opened' 
				name='button_text_opened' 
				type='text' 
				value="<?php echo ($botSettings['button_text_opened'] ? $botSettings['button_text_opened'] : ''); ?>">
		</div>
		<div class="lailo-settings-group">
			<div class="lailo-label-group">
				<label for="button_text_closed" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Button - Closed"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-use-secondary-color"><span class="help-text"><?php echo esc_html("Sets the text of the button when the input panel is closed."); ?></span></span>
			</div>
			<input
				class="lailo-input-field" 
				id='button_text_closed' 
				name='button_text_closed' 
				type='text' 
				value="<?php echo ($botSettings['button_text_closed'] ? $botSettings['button_text_closed'] : ''); ?>">
		</div>
		<div class="lailo-settings-group">
			<div class="lailo-label-group">
				<label for="input_placeholder" style="display: inline; margin-left: .2rem; vertical-align: unset;"><?php echo esc_html("Input Placeholder"); ?></label>
				<span class="dashicons dashicons-editor-help help-icon help-use-secondary-color"><span class="help-text"><?php echo esc_html("Sets the placeholder within the input field."); ?></span></span>
			</div>
			<input
				class="lailo-input-field" 
				id='input_placeholder' 
				name='input_placeholder' 
				type='text' 
				value="<?php echo ($botSettings['input_placeholder'] ? $botSettings['input_placeholder'] : ''); ?>">
		</div>
		<div class="lailo-settings-group" id="typeit-settings">
			<h4><?php echo esc_html("You can provide the avatar with a few short questions that will be used as examples. The texts are being typed after each other (the current text will be erased) under the user input field. There are three default texts for each choosable language."); ?></h4>
			<div id="language-example-section">
				<div class="language-example-group">
					<h4><?php echo esc_html("English"); ?></h4>
					<ul>
						<li><?php echo esc_html("e.g. Who are you?"); ?></li>
						<li><?php echo esc_html("e.g. What can you do for me?"); ?></li>
						<li><?php echo esc_html("Just ask me!"); ?></li>
					</ul>
				
				</div>
				<div class="language-example-group">
					<h4><?php echo esc_html("French"); ?></h4>
					<ul>
						<li><?php echo esc_html("p.ex. Qui est-tu?"); ?></li>
						<li><?php echo esc_html("p.ex. Que peux-tu faire pour moi?"); ?></li>
						<li><?php echo esc_html("Demandes-moi quelque chose!"); ?></li>
					</ul>
				</div>
				<div class="language-example-group">
					<h4><?php echo esc_html("German"); ?></h4>
					<ul>
						<li><?php echo esc_html("z.B. Wer bist du?"); ?></li>
						<li><?php echo esc_html("z.B. Was kannst du für mich tun?"); ?></li>
						<li><?php echo esc_html("Frag mich einfach!"); ?></li>
					</ul>
				</div>
			</div>
			<h4><?php echo esc_html("If you wish to use your own, go ahead!"); ?></h4>
			<?php
				if( $botSettings['example_questions']){
					foreach( $botSettings['example_questions'] as $str){
						?>
							<div>
								<input class="lailo-input-field" type="text" name="example_questions[]" value="<?php echo esc_html($str); ?>">
								<span class="dashicons dashicons-remove delete-typeit-row-btn"></span>
							</div>
						<?php
					}
				}
			?>
			<button class="button button-info" id="add-new-typeit-row-btn"><?php echo esc_html("Add new sample text"); ?></button>
		</div>
		<div class="lailo-settings-group">
			<div class="lailo-label-group">
				<label for="api_version"><?php echo esc_html("API Version"); ?></label>
				<a href=<?php echo esc_url("https://www.lailo.ai"); ?> target="_blank" rel="noopener noreferrer" class="dashicons dashicons-editor-help help-icon help-api-version"><span class="help-text"><?php echo esc_html("The API version is used to choose between different Avatar versions. Please contact the Lorent IT-Lösungen GmbH for more details."); ?></span></a>
			</div>
			<input
				required
				class="lailo-input-field" 
				id='api_version' 
				name='api_version' 
				type='text' 
				value="<?php echo ($botSettings['api_version'] ? $botSettings['api_version'] : 'v1'); ?>">
		</div>
		
		</div>
	</div>

	<br />

	<input class="lailo-input-field" type="hidden" name="action" value="lailo_update_bot_options">
	<input class="lailo-input-field" type="hidden" name="old_shortcode_id" value="<?php echo ($botSettings['shortcode_id']); ?>">
	
	<button class="button button-primary clear" type="submit" id="save-settings-btn"><?php echo esc_html("Save"); ?></button>

</form>

<script>
	document.addEventListener("DOMContentLoaded", () => {

	const typeItDeleteBtns = document.querySelectorAll(".delete-typeit-row-btn");

	if(typeItDeleteBtns){
		typeItDeleteBtns.forEach(btn => hookUpDeleteButton(btn));
	}

	const triggerAdvanced = document.getElementById("trigger-advanced-settings");
	const triggerIcon = document.getElementById("trigger-icon");
	triggerIcon.addEventListener("click", () => {
		triggerAdvanced.classList.toggle("advanced-show");
	})

	const privacySettingsContainer = document.getElementById("lailo-privacy-settings");
	const usePrivacyConsentCheckbox = document.getElementById("use_privacy_consent");

	usePrivacyConsentCheckbox.addEventListener("change", togglePrivacySettingsShow);
	
	function togglePrivacySettingsShow() {
		privacySettingsContainer.dataset.showTextSettings = usePrivacyConsentCheckbox.checked;
	}

	const typeitSettings = document.getElementById("typeit-settings");
	const addNewTypeitBtn = document.getElementById("add-new-typeit-row-btn");
	addNewTypeitBtn.addEventListener("click", addNewTypeitRow);

	function addNewTypeitRow(e){
		e.preventDefault();

		const id = Math.random();
		const stringField = document.createElement("div");
		
		const row = document.createElement("input");
		row.className = "lailo-input-field";
		row.type = "text";
		row.name = "example_questions[]";
		row.required = true;
		row.placeholder = "Insert sample text";

		const deleteBtn = document.createElement("span");
		deleteBtn.className = "dashicons dashicons-remove delete-typeit-row-btn";
		hookUpDeleteButton(deleteBtn);

		stringField.append(row);
		stringField.append(deleteBtn);

		typeitSettings.insertBefore(stringField, addNewTypeitBtn);
	}

	function hookUpDeleteButton(btn){
		btn.addEventListener("click", (e) => {
			btn.parentElement.remove();
		})
	}

	const saveBtn = document.getElementById("save-settings-btn");
	saveBtn.addEventListener("click", () => {

		const allFieldsValid = Array.from(document.querySelectorAll("input"))
		.map(field => field.value)
		.every(val => val.length > 0);
		
		if(allFieldsValid){
			saveBtn.className = "button button-warning";
			saveBtn.textContent = "Loading....";
		}
	})

	const widgetTypeWarning = document.getElementById("widget-type-warning");
	const widgetTypeSelect = document.getElementById('widget_type');

	function displayWarning(select){
		if(select.value === "fullScreenWidget"){
			widgetTypeWarning.innerHTML = '<span class="dashicons dashicons-warning"></span>Please note that this widget type requires an empty page. Otherwise the Avatar might be covered by other HTML elements.'
		}else{
			widgetTypeWarning.innerHTML = ""
		}
	}

	widgetTypeSelect.addEventListener("change", (e) => displayWarning(e.target));

	displayWarning(widgetTypeSelect);
	})
</script>