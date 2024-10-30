=== Lailo - AI Avatar ===
Contributors: maxilorent
Tags: chatbot, ai, ki, avatar, lailo, smart, character, multilangual, live
Requires at least: 4.0
Tested up to: 5.9
Stable tag: 1.4.2
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds your individual Lailo - AI Avatar to any page. See https://www.lailo.ai/en/ to learn more about Lailo - AI Avatars if you do not know them so far.


== Description ==
= Summary =
This plugin let's you easily integrate your individual [Lailo - AI Avatar](https://www.lailo.ai/en/) to any of your Wordpress pages. 

= Details =
This plugin helps you to easily integrate the Lailo - AI Avatar on your WordPress websites using the standard Wordpress shortcodes. Integrated into your website, Lailo e.g. can help your website visitors with questions or searches or play back media of all kinds. This way, it inspires its users not only as a digital assistant, but also as an intelligent search and clever product advisor. And of course it speaks all the major world languages and even understands dialects without any problems. Its appearance is just as changeable as its possible applications. Further information about the Lailo - Ai Avatar, some sample application scenarios can be found here: [https://www.lailo.ai/en/](https://www.lailo.ai/en/).

= Step by step integration =
In order to integrate your Lailo - AI Avatar, use this plugin to first create a new Lailo - AI Avatar configuration and choose a descriptive name for it. Next, connect your configuration with your Lailo - AI Avatar by copying the [Bot Secret](https://portal.lailo.ai/Bots/BotSettings) from the [Lailo Portal](https://portal.lailo.ai) and inserting it into the corresponding configuration field. After this, specify how the Lailo - AI Avatar shall be displayed on your pages. Choose from multiple different widget types and easily adjust colors to fit your corporate design and theme. As a second last step, set the language of your Lailo - AI Avatar configuration to the same language as specified in the Lailo portal. Of course, Lailo - AI Avatars support all major languages. However, the plugin currently only supports English and German, so that we'd like to invite you to write an email to our [support team](mailto:info@lailo.ai) if you need support for other languages. Finally, press the save button and you will find your new AI Avatar entry in the overview table.

Once you successfully created your AI Avatar configuration you will find a short code in the rightest column of the configuration overview table. Copy the shortcode and open the the page in which you would like to insert your AI Avatar. Paste the shortcode to the top of your page. If you now visit this page the Avatar will be displayed and you can start interacting with it. Simple as that!

Please note: you can have multiple Avatars with different settings throughout your website but make sure to always only add **one shortcode per page.** For example you can have a Half Screen Widget on your About Page and a Tiny Widget on your front page. Don't forget to make sure that you inserted the correct shortcode (especially after editing the Avatar's name).

If you have any questions feel free to contact our [support team](mailto:info@lailo.ai) at any time.


= About =
To learn more about the Lailo - Conversational UI Platform and its product Lailo - AI Avatar please visit our [website](https://www.lailo.ai/en/). We hghly encourage you to play around with the demo AI Avatar presented on this website.

= Privacy notices =
For privacy information please see [https://www.lailo.ai/en/privacy-policy](https://www.lailo.ai/en/privacy-policy).



== Frequently Asked Questions ==

This is the first public version of the Plugin. Thus there are not FAQs so far. Of course, we'll update the FAQs as soon as the Wordpress community starts using our plugin.


== Screenshots ==

1. Lailo usage example "Online Shop"
2. Lailo usage example "Public Utility"
3. Lailo usage example "Airport"
4. Lailo usage example "Zoo"
5. Lailo usage example "Software"
6. Lailo usage example "DIY Store"
7. Lailo usage example "Train Station"
8. Lailo usage example "Beauty Website"
9. Lailo usage example "Restaurant"
10. Lailo usage example "Supermarket"
11. Lailo usage example "City"
12. Lailo usage example "University"
13. Lailo usage example "Health insurance"
14. Lailo usage example "Hospital"
15. Lailo usage example "Trade Fair"
16. Lailo usage example "Museum"
17. Lailo usage example "Industry"
18. Plugin backend overview
19. Create a new Lailo - AI Avatar configuration
20. Edit an existing Lailo - AI Avatar configuration


== Changelog ==

= 1.0.0 =
Initial version of the Lailo - AI Avatar plugin.

= 1.0.1 =
Some minor descriptive updates to improve descritpion quality.

= 1.1.0 =
Some minor fixes.

= 1.2.0 =
Renamed a few internal variables and changed render location of the Avatar container.

= 1.3.0 =
Added the possibility to change the title, button texts and input field placeholder of the Avatar.

= 1.3.1 =
Bump up version

= 1.3.2 =
Hotfixed Apple issues regarding CSS font-weight and color inconsistencies.

= 1.3.3 =
Bumped up version

= 1.3.4 =
Fixed version mixup

= 1.3.5 =
Fixed a bug that prevented color settings from working properly if the Avatar initialization failed.
Also tested usability on WordPress version 5.8.1

= 1.3.6 =
Tested compatibility for WordPress 5.9

= 1.4.0 =
Introduced new features:
- Background color settings
- Privacy settings. The Avatar will not create a connection with the user until the privacy declaration has been accepted
- URL settings. You can toggle if URLs should be opened in a different or in the same tab.

= 1.4.1 =
Hotfixed privacy description sanitization issues. Anchor tags and their attributes will be correctly displayed.

= 1.4.2 =
Added backwards compatibility for legacy color settings.

== Installation ==

1. Upload the entire `lailo-ai-avatar` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the **Plugins** screen (**Plugins > Installed Plugins**).

You will find **Lailo - AI Avatar** menu in your WordPress admin menu bar.