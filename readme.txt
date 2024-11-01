=== Update Logger ===
Contributors: polyplugins
Tags: update log, update logger, update, log, developer, dev, dev tool, developer tool
Requires at least: 4.0
Tested up to: 6.6.2
Requires PHP: 5.4
Stable tag: 1.0.1
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Log WordPress updates, so you can exclude 3rd party plugins from your repo.

== Description ==
**About**
Update Logger makes keeping track of WordPress updates easy. For those developers that use version control for their code base, this will allow you to ignore 3rd party plugins while still keeping logs of plugins that were updated to make debugging easier. Clean up your repository and make deployment faster with less overhead. Update Logger implements [Loginator](https://wordpress.org/plugins/loginator/) which helps make setup fast and secure, along with the added benefit of having an easy function to assist you with debugging. Simply use the loginator() function or one of it's static methods.

Features:

* Log plugin updates
* Uses Loginator to easily log essential information for debugging.

== Installation ==
1. Backup WordPress
1. Upload the plugin files to the /wp-content/plugins/ directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the ‘Plugins’ screen in WordPress

== Frequently Asked Questions ==
= Where are the logs stored? =
`/wp-logs/`

== Screenshots ==
1. Log

== Changelog ==
= 1.0.1 =

* Added: Required plugin header


= 1.0.0 =

* Initial Release