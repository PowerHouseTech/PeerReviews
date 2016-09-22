=== Simple Ajax Chat ===

Plugin Name: Simple Ajax Chat
Plugin URI: https://perishablepress.com/simple-ajax-chat/
Description: Displays a fully customizable Ajax-powered chat box anywhere on your site.
Tags: ajax, chat, chatbox, forum, html5, im, instant message, messaging
Author: Jeff Starr
Author URI: http://monzilla.biz/
Donate link: http://m0n.co/donate
Contributors: specialk
Requires at least: 4.1
Tested up to: 4.5
Stable tag: trunk
Version: 20160408
Text Domain: sac
Domain Path: /languages/
License: GPL v2 or later

Displays a fully customizable Ajax-powered chat box anywhere on your site.



== Description ==

Simple Ajax Chat makes it easy for your visitors to chat with each other on your website. There already are a number of decent chat plugins, but I wanted one that is simple yet fully customizable with all the features AND outputs clean HTML markup.

**Core Features**

* Designed to be the simplest possible *persistent* chat
* Works with all mobile devices (iPhone, Android, et al)
* Ajax goodness loads new chats without refreshing the page
* Allow anyone to chat or restrict chat to logged-in users
* Display chat messages in ascending or descending order
* Works great even when JavaScript is not available
* Option to play sound alert for chat messages
* Display the chat box in multiple locations
* Display chat form easily via shortcode
* Automatic smileys supported :)
* Strong anti-spam filters

**Form Features**

* Clean markup makes it easy to style the appearance as desired
* Includes default CSS styles and enables custom CSS via settings
* Includes complete map of all available CSS hooks
* Display form on any Post or Page with the SAC Shortcode
* Display form anywhere in your theme with the SAC Template Tag
* New chat messages fade-in with custom duration and color
* Links included in chats include `_blank` target attributes
* Timestamp for each chat message included in markup

**Settings Features**

* Plug-n-play functionality, no configuration required
* Lots of settings available to customize every detail
* Super-slick toggling settings screen keeps it simple
* Built-in control panel to edit and delete chats
* Built-in blacklist to ban specific phrases from chat
* Option to use logged-in username as the chat name
* On-demand restoration of all default settings

**Customize Everything**

* Set custom limit on the number of chat messages
* Set custom limit on the length of each chat message
* Option to require login/registration to participate
* Option to enable/disable URL field for usernames
* Option to use textarea for larger input field
* Customize the update interval for the Ajax-requests
* Customize the fade-duration for new chat messages
* Customize the intro and outro colors for new chats
* Customize the default message and admin name
* Customize the appearance with your own CSS
* Option to enable/disable custom styles
* Option to load the JavaScript only when chat box is displayed
* Options to add custom content to the chat box and chat form
* Alternate audio clips available to customize the alert sound
* Action and filter hooks provided for advanced customization

Plus much more! :)

**Translations**

Simple Ajax Chat supports translation into any language. Current translations include:

* French
* Russian
* Slovak



== Installation ==

**Installation**

1. Upload the plugin to your blog and activate
2. Visit the settings to configure your settings

[More info on installing WP plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins)


**Usage**

Once the settings are configured, you can display the form anywhere using the shortcode or template tag.

__Shortcode__

Use this shortcode to display the chat box on a post or page:

`[sac_happens]`

__Template Tag__

Use this template tag to display the chat box anywhere in your theme template:

`&lt;?php if (function_exists('simple_ajax_chat')) simple_ajax_chat(); ?&gt;`


**Upgrades**

To upgrade Simple Ajax Chat, remove the old version and replace with the new version. Or just click "Update" from the Plugins screen and let WordPress do it for you automatically.

__Important!__ Two plugin files have changed names in version 20160408. So if you are upgrading from any version older than 20160408, make sure to DEACTIVATE the plugin BEFORE performing the update. Then after upgrading, reactivate the plugin and you're good to go.

__Note:__ uninstalling the plugin from the WP Plugins screen results in the _removal of all settings and chat messages_ from the WP database. 


**Restore Default Options**

To restore default plugin options, either uninstall/reinstall the plugin, or visit the plugin settings &gt; Restore Default Options.


**Uninstalling**

Simple Ajax Chat cleans up after itself. All plugin settings and chat messages will be removed from your database when the plugin is uninstalled via the Plugins screen.


**Stopping spam**

This plugin works in two modes:

* "Open Air" mode - anyone can chat
* "Private" mode - only logged-in users can chat

"Private" mode stops all automated spam, but registered users may still send "spammy" chat messages. Likewise, the "Open Air" mode is super effective at blocking automated spam, but some manual spam may get through. As a general rule, the longer your chat forum is online, the more of a target it will be for spam.

Alternately/additionally you can [use .htaccess to block spammers](https://wp-mix.com/htaccess-block-spammer/). It's an easy, super-effective method for controlling access to your site.



== Upgrade Notice ==

To upgrade Simple Ajax Chat, remove the old version and replace with the new version. Or just click "Update" from the Plugins screen and let WordPress do it for you automatically.

__Important!__ Two plugin files have changed names in version 20160408. So if you are upgrading from any version older than 20160408, make sure to DEACTIVATE the plugin BEFORE performing the update. Then after upgrading, reactivate the plugin and you're good to go.

__Note:__ uninstalling the plugin from the WP Plugins screen results in the _removal of all settings and chat messages_ from the WP database. 



== Screenshots ==

1. Simple Ajax Chat: Chat Box
2. Simple Ajax Chat: Plugin Settings

More screenshots available at the [SAC Homepage](https://perishablepress.com/simple-ajax-chat/#screenshots).



== Frequently Asked Questions ==

__Question:__ "How do I change the alert sound?"

__Answer:__ Open the directory `/resources/audio/` and replace the files `msg.mp3` and `msg.ogg` with your desired audio files. You will notice lots of alternate sound files included in that same directory. Simply rename any pair of files to replace the defaults.

__Question:__ "Where can I find a complete list of CSS selectors for styling the form?"

__Answer:__ Check out `sac.css` located in the `resources` directory.

__Question:__ "Can we auto delete after some minutes all the chats?"

__Answer:__ Yes, please see this post: [WordPress Cron Tips](https://wp-mix.com/wordpress-cron-tips/)

__Question:__ "I'm interested to know if your chat plugin has the option to respond to chats via an iPhone app or another chat software. I didn't see how the chats are received."

__Answer:__ Yep, the chat plugin works great on iPhones, Android devices, and more.. the functionality is achieved using Ajax.

__Question:__ "Is it possible to whitelist SAC plugin files?"

__Answer:__ Yes, check out [Simple Ajax Chat .htaccess whitelist](https://wp-mix.com/simple-ajax-chat-htaccess-whitelist/) and/or [Whitelist POST access with .htaccess](https://wp-mix.com/whitelist-post-access-htaccess/)

__Question:__ "How do i get rid of the chat saying "Latest Message: X minutes ago" in the chat?"

__Answer:__ Add this CSS to hide the display of the "Latest Message" info:

	#sac-latest-message { display: none; }

You can add that to the plugin setting, "Custom CSS styles" or your theme styles, wherever. If adding via the plugin setting, make sure that the associated setting, "Enable custom styles" also is enabled.

__Question:__ "How do I hide the Name, URL, and Message labels on the chat form?"

__Answer:__ You could add the following CSS to hide display of the form labels:

	#sac-form label { display: none; }

You can add that to the plugin setting, "Custom CSS styles" or your theme styles, wherever. If adding via the plugin setting, make sure that the associated setting, "Enable custom styles" also is enabled.

__Question:__ "Is it able to remove the "say it" button and just have send when press enter?"

__Answer:__ Yes once again you can use CSS to hide the submit button:

	#sac-user-submit { display: none; }

You can add that to the plugin setting, "Custom CSS styles" or your theme styles, wherever. If adding via the plugin setting, make sure that the associated setting, "Enable custom styles" also is enabled. Note that this is not recommended because the submit button is needed to send chat messages when JavaScript is not available in the user's browser.

__Question:__ "The form ls not displaying correctly, it looks all messed up. How do I fix this?"

__Answer:__ Simple Ajax Chat is designed to look great on any of the default WP themes and most other themes as well. Even so, every theme is different, and it's impossible to test on the hundreds of thousands of themes that are available. So if the chat form is not looking awesome on your theme, it's because your theme for whatever reason is applying its own particular styles. If this is the case, you can try disabling the plugin setting to "Enable custom styles". If that doesn't help, you can include your own custom CSS, or customize the plugin's default styles. Alternately, you may include custom CSS via your theme's stylesheet, and/or modify your theme's CSS as needed to make things display as desired. Tip: to see how the chat form *should* look, check it out using any of the default WP themes.

__Question:__ "The chat form is visible but new chat messages are not displayed."

__Answer:__ If this is happening, and/or if you are receiving a "Failed opening required" error message, most likely your site's `wp-load.php` file is not located in the usual default location (i.e., it has been moved to a custom location). If this is the case, you will need to edit the paths in `/simple-ajax-chat-core.php` (line 4) and `/resources/sac.php` (line 10). At some point I will be revamping the plugin so that this modification won't be necessary.

__Got a question?__

Send any questions or feedback via my [contact form](https://perishablepress.com/contact/)



== Support development of this plugin ==

I develop and maintain this free plugin with love for the WordPress community. To show support, you can [make a cash donation](http://m0n.co/donate), [bitcoin donation](http://m0n.co/bitcoin), or purchase one of my books: 

* [The Tao of WordPress](https://wp-tao.com/)
* [Digging into WordPress](https://digwp.com/)
* [.htaccess made easy](https://htaccessbook.com/)
* [WordPress Themes In Depth](https://wp-tao.com/wordpress-themes-book/)

And/or purchase one of my premium WordPress plugins:

* [BBQ Pro](https://plugin-planet.com/bbq-pro/) - Pro version of Block Bad Queries
* [SES Pro](https://plugin-planet.com/ses-pro/) - Super-simple &amp; flexible email signup forms
* [USP Pro](https://plugin-planet.com/usp-pro/) - Pro version of User Submitted Posts

Links, tweets and likes also appreciated. Thanks! :)



== Changelog ==

**20160408**

__Important!__ Two plugin files have changed names in this version. So DEACTIVATE the plugin BEFORE performing the update. Then after upgrading, reactivate the plugin and you're good to go.

* Refactored plugin JavaScript for better performance
* Swapped names of core plugin and chat process files
* Added more granular control over script loading
* Further testing on WordPress version 4.5 beta

**20160401**

* Refactored simple-ajax-chat-core.php
* Replaced sac_add_to_head() with sac_enqueue_scripts()
* Removed unnecessary $user_ID and get_currentuserinfo() in simple_ajax_chat()
* Removed unnecessary $user_ID, $user_identity, and get_currentuserinfo() in sac_happens()
* Refactored uninstall.php
* Refactored simple-ajax-chat.php
* Optimized nonce handling
* Refactored simple-ajax-chat-form.php
* Restyled default chat/form display
* Removed redundant default options
* Tweaked simple-ajax-chat-admin.php
* Added `sac_process_chat_action` hook
* Added `sac_process_chat_filter` hook
* Added auto-clear chats cron functionality
* Added sac_truncate_chats_action hook
* sac_truncate_chats_interval_filter hook
* Added more chat alert sound files
* Removed player.swf file (not used)
* Changed the default alert sound
* Removed redundant esc_sql() from edit chat and delete chat functions
* Added stripslashes() to name display on form, and to edit/add chat functions
* Removed stripslashes() from plugin settings screen
* Added Slovak translation (thanks to lulu108)
* Increased size of manage chat buttons
* sac.php now includes WP the same way as simple-ajax-chat.php
* Replaced icon with retina version
* Added screenshot to readme/docs
* Added retina version of banner
* Reorganized and refreshed readme.txt
* Tested on WordPress version 4.5 beta

**20151110**

* Updated heading hierarchy in plugin settings
* Added missing get_currentuserinfo() where applicable
* Updated some i18n code and added French translation (Thanks to alysko)
* Added Russian translation (Thanks to [arniarni](http://butyn-59.ru/))
* Improved logic of database query in sac_shout_edit()
* Added esc_url() to sac_add_to_head()
* Updated default translation template
* Updated minimum version requirement
* Tested on WordPress 4.4 beta

**20150808**

* Tested on WordPress 4.3
* Updated minimum version requirement
* Fixed 404/500 error for certain setups

**20150507**

* Tested with WP 4.2 + 4.3 (alpha)
* Changed a few "http" links to "https"
* Fixed XSS vulnerability with add_query_arg()
* Added primary key flag to create database function
* Bugfix: form not submitting when JavaScript disabled
* Improved logic in simple-ajax-chat.php
* Added nonce security to chat form
* Added support for SSL/https
* Added sac_censor_replace filter to customize censored words
* Added isset() to stop PHP warning

**20150316**

* Tested with latest version of WP (4.1)
* Increased minimum version to WP 3.8
* Added $sac_wp_vers for version check
* Added Text Domain and Domain Path to file header
* Removed deprecated screen_icon()
* Added alert notice for donations
* Streamline/fine-tune plugin code
* Replaced time() with current_time() throughout plugin
* Added timestamp for each chat via data-time attribute
* Replace $user_level and $sac_admin_user_level with current_user_can()
* New feature: option to set max number of allowed chats
* New feature: option to set max number of characters per chat
* New feature: option to set max number of characters in username
* Replaced hard-coded values for max chats/chars/name with options
* Revamped chat-order functionality (Thanks to MartinW2)
* Added line breaks to initJavaScript()
* Added rows="5" cols="50" to chat message textarea
* Updated auto-link regex, fixes backslash appended to URL
* Think I fixed the backslash-before-apostrophes issue, let me know!
* Replaced default .mo/.po templates with .pot template

**20140923**

* Tested on latest version of WordPress (4.0)
* Increased minimum version requirement to WP 3.7
* Added conditional check to min-version function
* Added option to display logged-in username as chat name
* Improved logic of simple_ajax_chat()
* Improved logic of sac_addData()
* Improved logic in core and admin files
* Increased default username max-length
* Fine-tuned plugin settings page
* Removed vestigial killswitch variable
* Fixed issue where special characters were not displaying correctly
* Replaced hardcoded paths with WP tags (e.g., wp-content directory)
* Replaced $user_nickname global with wp_get_current_user()
* Minified portions of the SAC JavaScript file for better performance
* Added conditional check for $sac_lastID is numeric
* Now using sanitize_text_field() for IPs
* Replaced htmlspecialchars() with sanitize_text_field()
* Replaced sac_special_chars() with esc_url() for user URL
* Replaced htmlentities(), stripslashes(), sac_clean() with sanitize_text_field()
* Replaced PHP tags with WP tags in sac_special_chars()
* Updated mo/po translation files

**20140305**

* New feature: added setting to display chats in ascending or descending order (beta)
* Improved logic for creating chat db table, fixes "mysql_list_tables" deprecated error
* Added various CSS selectors to chat messages for custom styling
* Added support for localization/translation

**20140123**

* Tested with latest WordPress (3.8)
* Added trailing slash to load_plugin_textdomain()
* Fixed 3 incorrect _e() tags in simple-sjax-chat-admin.php
* Edited setting description for "Require log in?" for accuracy

**20131107**

* Removed `delete_option('sac_delete');` from uninstall.php
* Replaced `application/x-javascript` with `` in sac.php
* Replaced `add_plugin_links` with `add_sac_links` in simple-ajax-core.php

**20131106**

* Replaced original header codes and WP includes in sac.php

**20131105**

* Removed 3x "&Delta;" from die() for better security
* Added "rate this plugin" link on Plugins and SAC settings screens
* Replaced 3x "wpdb->escape" with "esc_sql" in simple-ajax-chat-core.php
* Filter server variables with built-in simple-ajax-chat-admin.php (lines 65/66)
* Improved security when submitted chat fails (simple-ajax-chat.php)
* Specified no border for smileys in filter_smilies()
* Added localized timestamp of last chat to span.name in sac.php
* Localized "ago" in sac-admin, sac-core, and sac-form
* Localized sac_time_since() in simple-ajax-core.php
* Improved header codes and WP includes in sac.php
* Fixed bug where chats don't work if audio is disabled
* Added uninstall.php to remove options and chat table upon uninstall
* Enhanced functionality of plugin settings page
* Tested with latest version of WordPress (3.7)
* General code maintenance and cleanup
* Added support for localization

**20130725**

* Tightened form security
* Tightened plugin security
* Updated deprecated functions
* Resolved some PHP Notices

**20130713**

* Improved localization support
* Replaced some deprecated template tags

**20130712**

* Reorganized file/directory structure
* Separated Ajax stuff from core plugin
* Implemented strong anti-spam measures
* Many functions rewritten to maximize native WP functionality
* Improved audio support for chat alerts, fixed Safari bug
* Fixed: case-insensitive banned phrases
* Fixed: default options not working on install
* Fixed: a bunch of annoying PHP Notices
* Added .sac-reg-req for registration message div#sac-panel
* Updated CSS skeleton with new selector (@ "/resources/sac.css")
* Fixed: enable/disable links for usernames now works properly
* General code check n clean
* added comments to the .htaccess file (no active rules are included)

**20130104**

* Added JavaScript to set up sound-alerts (fixes undefined variable error)

**20130103**

* Added margins to submit buttons (now required in WP 3.5)
* Added "div#sac-panel p {}" to default CSS
* Added links to demo in readme.txt file
* Updated all instances of $wpdb->prepare with new syntax
* Added option for sound to play for new chat messages (note: chat-sound technique is borrowed from "Pierre's Wordspew")

**20121206**

* Edited line 217 to define variable and fix "timeout" error
* Enhanced markup for custom content
* Custom content may be added before and/or after the chat form and/or the list of chat messages

**20121119**

* Fixed PHP Warning: [function.stristr]: Empty delimiter (line 282)
* Removed fieldset border in default form styles (plugin settings)
* Added placeholders for name, URL, and chat message

**20121110**

* Initial release.


