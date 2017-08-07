=== Genesis Subpage Sidebar ===
Contributors: jonschr
Donate link: http://redblue.us/
Tags: subpage, navigation, genesis, studiopress, sidebar, page, widget, menu
Requires at least: 3.8
Tested up to: 3.9.1
Stable tag: 0.0.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin replaces your Genesis primary sidebar with a list of child pages (supports custom post types). Only works with Genesis child themes.

== Description ==

This plugin should only be used on Genesis sites (on non-Genesis sites, it won't break anything, but it also won't do anything at all).

Once the plugin is active, you'll be able to see it in action by going to any parent page or child page which shows the Primary widget area. Navigating to either the parent page or a subpage will keep the same menu in place (it shows the top-level page and the child pages of that top-level page).

Custom post types are fully supported, *as long as they are heirarchical.*

This plugin replaces the primary widget area with this subnavigation. When you scroll down on a long page on which that new subnavigation appears, the subnav will scroll with you.


== Installation ==

1. Use the Genesis framework. *If you aren't using a Genesis child theme, this plugin will not work with your site.*
1. Unzip the plugin and upload the folder to the '/wp-content/plugins/'' directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. That's it! There aren't currently any options to configure.

== Frequently Asked Questions ==

= So how does this work? =

Basically, the plugin detects whether a page either has subpages or is itself a child page. If your page is in a child-to-parent relationship, it replaces your primary sidebar with a styled, unordered list of the parent page, then all of that parent's child pages. (You can turn off default styling.)

*tldr: This makes it nearly automatic to create "sections" for your website*

= Does this plugin have a settings page or anything that needs to be set up before using it? =
Yep, but only to customize the functionality. You can use it without touching the settings.

= How is this plugin different from Bill Erickson's Genesis Subpages as Secondary Menu plugin or his BE Subpages Widget? =

Those plugins each do something kind of similar, but with your secondary menu for the former or with a widget for the latter. I like to put these sorts of things in the sidebar, and I especially like it if they scroll down as the user does. So this plugin does those bits automatically instead of the things each of those do automatically.

== Changelog ==
= Version 0.0.9 =
* Fixed bug when someone hasn't yet touched the scroll option (the sidebar was being erroneously removed)

= Version 0.0.8 =
* Added compatibility with Genesis Simple Sidebars (previously, those sidebars weren't being removed when the setting in Genesis Subpage Sidebar said they should be.)

= Version 0.0.6 and 0.0.7 =
* Bug fixes

= Version 0.0.5 = 
* Added some basic settings

= Version 0.0.4 = 
* Restructured how the plugin enqueues files to make sure they're only loaded in places where they're needed
* Added support for heirarchical custom content types

= Version 0.0.3 =
* Fixed a jquery error being caused by the plugin on pages with a gravity form using conditional logic

= Version 0.0.2 =
* Support added for sidebar-content layout
* Support added for footer widgets (fixed subnav won't overflow onto your widgets)
* Stylesheet cleanup

= Version 0.0.1 =
* Initial commit
