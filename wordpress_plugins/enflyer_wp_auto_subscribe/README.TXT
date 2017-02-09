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

For example if you have an Enflyer contact member list called 'WordPress Users' - You can create an Enflyer sign up form for that list. Once you have this plugin connected
to that signup form, all new users to your WordPress powered site will instantly be added to the 'WordPress Users' member list in your Enflyer Application.

== Installation ==

1. While logged into your account on the Enflyer application you will need to create a signup form (sometimes called autoforms) at url https://enflyer.emsvc.net/autoforms.php
 - Note - At this time, the Enflyer Auto Subscribe plugin only supports transmission of the email address. This means when creating your signup form you should not add any other fields to the signup form other than 'email' (which is always selected by default)

1. Once you have created the sign up form. You will see it in your sign up form list in the Enflyer Application at http://enflyer.emsvc.net/autoforms.php.  Click on the 'Link' ooption for the signup form you want to connect the Enflyer Auto Subscribe Wordpress Plugin too. You will see some information regarding that autoform. Towards the bottom of the information block you will see a section called 'Autoform ID / Autoform Key'.  Make note of the Autoform ID and Autoform Key values shown. Those are the values you will need to set in your Wordpress Settings for this plugin.

1. To set up the Enflyer Auto Subscrine plugin on your WordPress site - Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.

1. Activate the Enflyer Auto Subscribe plugin through the 'Plugins' screen in WordPress

1. Use the Settings->Enflyer Auto Subscribe screen to configure the plugin. The settings screen for the plugin will have two fields to set.  The Autoform ID and the Autoform key. Set those to match the values you noted from the signup form 'link' screen.  Save the settings.


Thats all there is to it! Now you wont have to manage your wordpress users and your Enflyer members separately!

== Changelog ==
= 1.0 = 
* First release
