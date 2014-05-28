=== Advanced Content Tracking with Google Analytics ===
Contributors: megalytic
Donate link: http://megalytic.com
Tags: analytics, reporting, content tracking, google analytics
Requires at least: 3.9.1
Tested up to: 3.9.1
Stable tag: 1.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl.html

Implementation of Justin Cutroni's Advanced Content Tracking suggestions.

== Description ==

WordPress Plugin that implements Justin Cutroni's Advanced Content Tracking as described
http://cutroni.com/blog/2012/02/21/advanced-content-tracking-with-google-analytics-part-1/ and
http://cutroni.com/blog/2012/02/23/advanced-content-tracking-with-google-analytics-part-2/

This plugin fires Google Analytics events that track how much of a post's content have been
read and how much time a visitor spent reading.

Read this blog post to learn how the Google Analytics tracking works:
http://cutroni.com/blog/2012/02/21/advanced-content-tracking-with-google-analytics-part-1/

Read this blog post to learn how to create reports in Google Analytics using the tracking
provided by this plugin:
http://cutroni.com/blog/2012/02/23/advanced-content-tracking-with-google-analytics-part-2/

You can configure this plugin under Settings >> Content Tracking with GA.  The available options are:
* Run in debug mode? - set this to true and no Google Analytics events are fired; instead you will get alert messages indicating when they would have been fired.  To test that the plugin is working, set this option to True and scroll through a post.  You should get alert windows popping up as you scroll down to the bottom.
* jQuery selector for the content DIV - set this to the class (or other selector) of the DIV that contains the content in your posts.  By default, it is set to the string ".entry-content" which the class of the DIV used to hold content in many WordPress blog themes.
* Delay after scroll event before checking location (milliseconds) - set this to adjust the delay between a scroll event and when the plugin checks how far down the visitor has scrolled.  100 milliseconds is the default.
* Distance from top of content that indicates reading has started (pixels) - set this to adjust how far down you want the visitor to scroll before you count him as having "started reading".  150 pixels is the default.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the folder `cutroni-content-tracking` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.0 =
* Initial release.

