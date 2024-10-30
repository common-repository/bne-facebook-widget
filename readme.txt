=== BNE Facebook Widget ===
Author URI: http://www.bnecreative.com
Contributors: bluenotes
Tags: facebook, facebook like box, facebook widget
Requires at least: 4.6
Tested up to: 5.2
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds a simple Facebook widget like box for your WordPress sidebar or custom widget areas.

== Description ==

This Facebook widget will provide you a simple and attractive way to display your Facebook Page like box within your WordPress sidebar or custom widget area.

= Facebook Widget Options =

* Responsive
* URL
* Show the following tabs: timeline, events, messages
* Width
* Height
* Hide cover photo
* Show friend's faces
* Hide the custom call to action button (if available)
* Use small header

= Facebook Shortcode Options =

In addition to the widget, you can also add the Facebook like box anywhere with a shortcode.
Example:

`[bne_facebook_widget url="https://www.facebook.com/arrowsmiledental/" tabs="timeline, messages" width="500"]`

Shortcode Arguments:

* url - The full URL to the Facebook page
* tabs - A comma separated list of tabs to display within the widget. Options: timeline, events, messages
* width - The pixel width of the widget. Minimum is 180 and Maximum is 500.
* height - The pixel height of the widget. Minimum is 70.
* hide_cover - Hide Cover Photo. Options: true or false
* show_facepile - Show Friend's Faces. Options: true or false
* hide_cta - Hide the custom call to action button (if available). Options: true or false
* small_header - Use Small Header. Options: true or false
* adapt_width - Adapt to widget container width. Options: true or false

== Installation ==

1. Upload "bne-facebook-widget" folder to the "/wp-content/plugins/" directory
2. Activate the plugin through the "Plugins" menu in WordPress
3. Add the widget BNE Facebook Page Like Box wherever you want through the 'Appearance -> Widgets' interface. Make sure to fill out App ID and URL!

== Screenshots ==

1. Widget - BNE Facebook Page Plugin in front-end.
2. Widget - BNE Facebook Page Plugin in administration.

== Changelog ==

= 1.1 Jun 30, 2018 =
* Update to use Facebook JS SDK v3.0
* Set App ID option be an optional as it is not required with display.
* Fix incorrect query version string added to the Facebook SDK script.

= 1.0 (Aug 27, 2017) =
* First Public Release.
