<?php

require_once(plugin_dir_path(__FILE__).'/lailo_template_table.php');

class LailoAdminPage {

	static $instance;

	public $lailo_table;

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'plugin_menu']);
	}

	public static function get_instance() {
		if (!isset(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function plugin_menu() {
		$hook = add_menu_page(
			'Lailo - AI Avatar',
			'Lailo - AI Avatar',
			'manage_options',
			'lailo_template_table',
			[ $this,  'plugin_table_page' ],
			"dashicons-buddicons-buddypress-logo"
		);

		add_action( "load-$hook", [ $this, 'load_table']);
	}

	public function load_table() {
		$this->lailo_table = new Lailo_Template_Table();
	}

	public function plugin_table_page() {
		?>
		<style>
			table.lailo td,
			table.lailo th{
				text-align: center !important;
			}

			table.lailo td:first-child,
			table.lailo th:first-child{
				text-align: left !important;
			}
			
			table.lailo .delete-template-btn{
				cursor: pointer;
			}
			
			table.lailo .delete-template-btn:hover{
				color: #a80000;
			}

			.intro-container{
				margin: 2rem 0;
			}

			.lailo-intro-text{
				background: white; 
				padding: 1rem; 
				font-size: 1rem;
				margin: 0;
			}

			#further-instructions-section{
				display: none;
				opacity: 0;
			}
			
			#further-instructions-section.show-further-instructions{
				display: block;
				animation: fadeIn 400ms forwards ease-out;
			}

			#reveal-btn-icon{
				margin-right: .4rem;
			}
			
			#toggle-further-info-btn{
				display: flex;
				align-items: center;
				justify-content: center;
				margin: 1rem 0 0 0;
			}

			@keyframes fadeIn{
				to{
					opacity: 1;
					transform: none;
				}
			}
		</style>
	<div class="wrap ">
		<h2><?php echo esc_html("Lailo - AI Avatar"); ?></h2>
		<div class="intro-container">
			<p class="lailo-intro-text"><?php echo esc_html("This plugin helps you to easily integrate the Lailo AI Avatar on your WordPress websites using the standard Wordpress shortcodes. Integrated into your website, Lailo e.g. can help your website visitors with questions or searches or play back media of all kinds. This way, it inspires its users not only as a digital assistant, but also as an intelligent search and clever product advisor. And of course it speaks all the major world languages and even understands dialects without any problems. Its appearance is just as changeable as its possible applications. Further information about the AI Avatar, some application scenarios, prices and individual demos can be found here:"); ?> <a target="_blank" rel="noopener noreferrer" href=<?php echo esc_url("https://www.lailo.ai/"); ?>><?php echo esc_url("https://www.lailo.ai/"); ?></a>.
				<button id="toggle-further-info-btn" class="button button-primary"><span class="dashicons dashicons-book-alt" id="reveal-btn-icon"></span><span id="reveal-btn-text"><?php echo esc_html("Show Further Instructions"); ?></span></button>
		</p>

			

			<div id="further-instructions-section">
				<p class="lailo-intro-text"><?php echo esc_html("In order to integrate your Lailo - AI Avatar, first use the button below to create a new Lailo - AI Avatar configuration and choose a descriptive name for it. Next, connect your configuration with your Lailo - AI Avatar by copying the Bot Secret from the"); ?> <a  target="_blank" rel="noopener noreferrer" href=<?php echo esc_url("https://portal.lailo.ai"); ?>><?php echo esc_html("Lailo Portal"); ?></a><?php echo esc_html(" and inserting it into the corresponding configuration field. After this, specify how the Lailo - AI Avatar shall be displayed on your pages. Choose from multiple different widget types and easily adjust colors to fit your design. As a second last step, set the language of your Lailo - AI Avatar configuration to the same language as specified in the Lailo portal. Of course, Lailo - AI Avatars support all major languages. However, the plugin currently only supports English and German, so that we'd like to invite you to write an email to our"); ?> <a href=<?php echo esc_url("mailto:info@lailo.ai"); ?>><?php echo esc_html("support team"); ?></a><?php echo esc_html(" if you need support for other languages. Finally, press the save button and you will find your new AI Avatar entry in the overview table."); ?></p>
	
				<p class="lailo-intro-text"><?php echo esc_html("Once you generated your AI Avatar you will find a short code in the rightest column. Open page in which you would like to insert your Avatar and paste the shortcode into your HTML. If you visit that page the Avatar will be displayed and you can interact with it. Simple as that! You can have multiple Avatars with different settings throughout your website but only one Avatar per page. For example you can have a Half Screen Widget on your About Page and a Tiny Widget on your front page. Don't forget to make sure that you inserted the correct shortcode (especially after editing the Avatar's name)."); ?></p>
			</div>
			
			<p class="lailo-intro-text"><?php echo esc_html("If you have any questions feel free to contact our "); ?><a href=<?php echo esc_url("mailto:info@lailo.ai"); ?>><?php echo esc_html("support team"); ?></a><?php echo esc_html(" at any time."); ?></p>
		</div>
		
		<hr/>
		
		<a class="button button-primary" style="margin-top: 2rem;" href=<?php echo(admin_url('admin.php')."?page=lailo_avatar_settings_page"); ?>><?php echo esc_html("New Lailo - AI Avatar Configuration"); ?></a>
		<div id="lailo-content">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div class="meta-box-sortables ui-sortable">
						<form method="post">
							<?php
							$this->lailo_table->prepare_items();
							$this->lailo_table->display(); ?>
						</form>
					</div>
				</div>
			</div>
			<br>
			<br class="clear">
		</div>
	</div>
	<script>
		document.querySelectorAll('.delete-template-btn').forEach(btn => {
			btn.addEventListener("click", () => {
				const shouldBeDeleted = window.confirm(`Are you sure you want to delete this configuration: ${btn.dataset.shortcodeId}?`)

				if(shouldBeDeleted){
					window.location.href = `${window.location.pathname}?page=lailo_template_table&action=delete&bot=${btn.dataset.shortcodeId}`;
				}
			})
		})

		const revealBtn = document.getElementById("toggle-further-info-btn");
		const revealBtnText = document.getElementById("reveal-btn-text");
		const furtherInfoSection = document.getElementById("further-instructions-section");

		revealBtn.addEventListener("click", () => {
			furtherInfoSection.classList.toggle("show-further-instructions");
			if(furtherInfoSection.classList.contains("show-further-instructions")){
				revealBtnText.textContent = "Hide Further Instructions";
			}else{
				revealBtnText.textContent = "Show Further Instructions";
			}
		})

	</script>

	<?php
	}

}