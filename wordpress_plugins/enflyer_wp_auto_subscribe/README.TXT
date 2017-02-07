=== Enflyer Auto Subscribe ===
Contributors: enmike
Tags: email marketing
Requires at least: 4.7
Tested up to: 4.7
Stable tag: 4.7
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Enflyer Auto Subscribe plugin for Wordpress

== Description ==

The purpose of this plugin is to allow users of the Enflyer email marketing system to connect an automatic
subscription to their Enflyer member list from their Wordpress site new users.  

Essentially whenever a new user signs up to your wordpress site the email address they enter will be instantly
added to the memberlist of your choice.  

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.

2. Activate the plugin through the 'Plugins' screen in WordPress

3. Use the Settings->Plugin Name screen to configure the plugin

4. In the Enflyer app you will need to create a signup form (sometimes called autoforms). 

5. At this time the wordpress plugin will only support transmission of the email address of the new user
so you will need to create an autoform with no fields except the email field.

6. Once you create the signup form you will be able to retrieve the autoform id and the autoform key. The memberlist associated
with the autoform you created will be the target for new members from your wordpress registrations.

7. Install the enflyer_subscribe wordpress plugin to your wordpress site. 

8. In the settings menu for the Enflyer Subscribe plugin, you will see two fields. autoform id and autoform key

9. Set the autoform id and the autoform key to the values provided in the signup form you created in the Enflyer app.

Thats all there is to it! Now you wont have to manage your wordpress users and your Enflyer members separately.
