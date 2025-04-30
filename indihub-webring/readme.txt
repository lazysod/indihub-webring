=== IndiHub Webring ===
Contributors: Barry
Contact: divinorum2001@gmail.com
Tags: webring, navigation, WordPress, community  
Requires at least: 5.0  
Tested up to: 6.4  
Requires PHP: 7.4  
Stable tag: 1.0  
License: MIT  
License URI: https://opensource.org/licenses/MIT  

== Description ==
IndiHub Webring allows you to seamlessly integrate a **webring navigation widget** into your WordPress site.  
Easily configure your settings to join the network and display dynamic navigation links.  

== Installation ==
1. Download the plugin ZIP file (`indihub-webring.zip`).  
2. Go to **WordPress Admin → Plugins → Add New**.  
3. Click **Upload Plugin**, select the ZIP file, and press **Install Now**.  
4. Activate the plugin under **WordPress Admin → Plugins**.  

== Configuration ==
1. Navigate to **WordPress Admin → Settings → IndiHub Webring**.  
2. Enter the required details:
   - **User ID** (provided by IndiHub)  
   - **Site ID** (your assigned site identifier)  
   - **Token** (authentication token for API access)  
3. Click **Save Changes**.

== Usage ==
1. Add the shortcode `[indihub_webring]` to a post, page, or widget.  
2. For manual integration, place this code inside a template file (`footer.php`, `sidebar.php`):
   ```php
   echo do_shortcode('[indihub_webring]');

== Troubleshooting ==
If the shortcode does not display, ensure the plugin is activated.
If the webring navigation is missing, check the browser console (F12 → Console) for script errors.
Try loading the webring manually with:
html
<script src="https://cdn.theindihub.org/js/webring.js"></script>

== Changelog == = 1.0 =
Initial release
Basic settings configuration

Shortcode support
== License == This plugin is licensed under the MIT License. See License URI for details.
