=== Custom Frames ===
Contributors: blakelong
Donate Link: staff@digital-scripts.com
Tags: custom, image, images, picture, frame, picture frame, border, picture border, shortcode, simple, plugin, media
Requires at least: 4.5.4
Tested up to: 4.7.1
Stable tag: 1.0.1
License: GPLv2 or later

Custom Frames allows you to easily create a picture frame without having to write any code.

== Description ==

https://www.youtube.com/watch?v=3vp6TnuD7jU

Custom Frames allows you to easily create a picture frame without having to write any code. You can add the frame to pictures by using the shortcode [customframe].

= Features =
* Border settings page to control the frames border
* Shadow settings page to control the frames shadow
* Caption settings page to how a caption would interact with the frame
* Easy to use shortcode to place the frame around a picture

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Through the admin dashboard navigate to personalize/custom frames
4. Once at the custom frames settings page create your desired picture frame
5. Add the custom frame to a picture with the shortcode [customframe src=""]

== Frequently Asked Questions ==

= Where is the settings page for Custom Frames located? =

The settings page for Custom Frames is under appearance/Custom Frames. 

= I created a frame, how do I apply it to a picture? =

Custom Frames uses the shortcode [customframe src=""] to apply the frame to picture. See Other Notes or the readme.txt for more information on the shortcode and its accepted attributes.

== Screenshots ==

1. Shows the settings page for the border
2. Shows the settings page for the shadow
3. Shows the settings page for the caption
4. Shows the shortcode and its accepted attributes

== Changelog == 

= Version 1.0.0 =

*Initial release of Custom Frames

== Shortcode ==

Custom Frames uses the shortcode [customframe] in order to specify which picture to apply the frame to.

The following shortcode accepts 5 attributes.
[customframe src="" height="" width="" caption="" class=""]

The src attribute is required and should be the url to the picture.
The height attribute is optional and is used to define the height of the picture. The default value is 300.
The width attribute is optional and is used to define the width of the picture. The default value is 450.
The caption attribue is optional and is used to add a caption to the picture.
The class attribue is optional and is used to add a css class to the picture frame.