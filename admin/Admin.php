<?php

namespace ServeStatic\Classes;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Admin {

    public function guide_sub_menu(){
        add_submenu_page( 'serve_static_settings', 'Guide', 'Guide', 'manage_options', 'serve_static_guide', array( $this, 'guide_callback'));
    }

    public function guide_callback(){ ?>
        <div class="wrap">
            <h1>Plugin Documentation</h1>
            </br>
            <div style="background-color: black; color: white; text-align: center; padding: 20px;">
                <b>Caching is fully disabled for Administrators, or any logged-in users. Static Cache will only be served to logged-out visitors of your site.</b>
            </div>
            </br>
            <div style="background-color: yellow; padding: 20px;">
                <b>Note that, the Static Cache can only be regenerated by using the buttons in the admin toolbar, or in the Cache Regenerate page. After the cache is Flushed, the cache is NOT regenerated when someone visits the pages. This is done so that none of the personalized content gets saved in the HTML caches.</b>
            </div>
            </br>
            <div style="background-color: green; color: white; padding: 20px; text-align: center;">
                This plugin may not work as expected with a caching plugin like WP Rocket or W3 Total Cache. So make sure the URLs of the static pages are excluded from the specific plugins.
                </br>For example, when using WP Rocket, you need to navigate under Settings > WP Rocket > Advanced Rules > Never Cache URLs, and enter the URLs to the pages you want to serve as Static.
                </br>When using W3 Total Cache, navigate under Performance > Page cache > Advanced > Never cache the following pages.
            </div>
            </br>
            <ul style="background-color: white; width: 300px; padding: 15px;">
                <li><a href="#general">General Functionality</a></li>
                <li><a href="#check-if-created">How to check if cache is working?</a></li>
                <li><a href="#check-if-cache-served">How to confirm if cache is served?</a></li>
                <li><a href="#bypass-cache">How to bypass the cache?</a></li>
                <li><a href="#auto-flush-cache">Which events trigger auto-flushing of the cache?</a></li>
                <p><b>Options</b></p>
                <li><a href="#enable-functionality">Enable Plugin Functionality</a></li>
                <li><a href="#static-method">Static Method</a></li>
                <li><a href="#all-static">Make all content as Static</a></li>
                <li><a href="#specific-post-types">Make specific post types Static</a></li>
                <li><a href="#enter-urls">Enter URLs manually to make them static</a></li>
                <li><a href="#minification">Minification</a></li>
                <li><a href="#always-exclude-urls">Always Exclude URLs</a></li>
                <li><a href="#interval-per-requests">Cache Warmup Requests Interval</a></li>
                <li><a href="#fallback-method">Fallback Method</a></li>
                <li><a href="#cron-time">Cron Time</a></li>
            </ul>

            <section id="general">
                <h2>General Functionality</h2>
                <p>This plugin creates static HTML versions of your pages/posts, or literally any custom post types, and serves them to your non-logged-in visitors. This is an awesome way to make your website blazing fast, and not even one request is made to PHP to request your pages.
                    </br></br>Anytime a Static page/post/any custom post type is updated, the cache of that specific page is automatically cleared, and regenerated. So, you do not have to worry about regenerating the cache eac time after making changes to your content.
                    </br></br>This plugin is also well-integrated with frontend post rating plugins as well, so that when any rating is added, the cache gets regenerated automatically. If you are using any rating plugins that are not working with this plugin, kindly let me know in the support forum.
                    </br></br><b>This plugin generates Static HTML cache files, and serves them to your users. So get started, simply set your options in <a target="_blank" href="<?php echo esc_url(admin_url('admin.php?page=serve_static_settings')) ?>">Settings</a>, and then navigate to <a target="_blank" href="<?php echo esc_url(admin_url('admin.php?page=serve_static_warmer')) ?>">Cache Generator</a>, and click on "Create Cache Files". If there are still any issues, kindly share in the plugin support thread.</b></br></br>By default, this plugin automatically works with Apache and Litespeed servers, and everywhere .htaccess rules is functional. But to make this plugin work with NGINX, you will be needing to add some rules to your nginx.conf or site.conf file. An appropiate admin notice will be shown to you accordingly, kindly follow those instructions.
                    </br></br>This plugin is supposed to work with all the form builder plugins like WP Forms, Ninja Forms. If you face any issues while using any form plugin, kindly let me know in the thread, and I will try to make it compitable.
                    </p>
            </section>

            <section id="check-if-created">
                <h2>How to check if the cache is create?</h2>
                <p>As an Administrator, you can view the page, and check the admin toolbar status to check if the cache is being created for a certain page, post or any custom post type.
                </br></br><img src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . '/assets/cached.png' ) ?>" width='900' height='200'> 
                </br></br><img src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . '/assets/no-cached.png' ) ?>" width='900' height='200'> 
                </br></br><img src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . '/assets/cache-missing.png' ) ?>" width='900' height='200'> 
                </br></br><p>There are currently 3 different things that can be shown.</p>
                    <ol><b style="color:green;">* Serve Static - Cached :</b> This means a valid cache of that page is currently present in the cache folder, and ready to serve.</ol>
                    <ol><b style="color:red;">* Serve Static - Not Cached :</b> This means that page is not in the Caching list defined by your settings from the Serve Static settings page. This either means, this page is addded in the exclusion list, or not set to cache using the settings.</ol>
                    <ol><b style="color:red;">* Cached but cache missing :</b> This means the cache of that page is enabled, and active via the Settings of Serve Static. But due to some reasons, a valid cache file of that page is NOT present in the cache folder, whcih means no cache will be served. Please regenerate the cache of that specific page using the "Regenerate Cache for this URL" button in the admin toolbar.</ol>
                </br>
                </p>
            </section>

            <section id="check-if-cache-served">
                <h2>How to confirm if cache is served?</h2>
                <p>As an Administrator, or with any user role, while logged-in, you cannot view a Static cached copy of any page. Cache is completly disabled for logged-in users. Static cache is only served to logged-out visitors of your website. Let's check how can you confirm is caching is being served to your logged-out visitors:
                </br></br>At first, set the Settings in your Serve Static settings page, and Regenerate the Cache. Then, open up the page in an incognito window, for which you enabled the caching.
                </br></br>If Static Caching is working properly, the page should already be loading blazing fast for you in the incognito window. To completely verify, right click on the webpage, and click "View Page Source".
                </br></br>Firstly, you should notice very small amount of HTML lines, probably around 10-15 or even less (If you have enabled HTML, CSS and JS minifications together). Secondly, scroll down to the last line of the HTML code, and you should notice something like below:
                </br><pre style="color:green;">Cached by Serve Static</pre>
                </br>This indicates that the cache is currently being properly cached and served as Static. To fetch that page, not even a single request is made to the PHP, this is being served fully from pure HTML, CSS, and Javascript.
                </br></br>If this doesn't appear, that means the page is either not cached, or not served form the cache. Kindly regenerate the cache of that page, or try to do a plugin conflict. If the issue still persists, please share in the support forum, and I will try to help you out.
                </p>
            </section>

            <section id="bypass-cache">
                <h2>How to bypass the cache to check if Serve Static is causing the issue on your page?</h2>
                <p>Well, sometimes you might just want to bypass the cache and check how the page appears without the cache from Serve Static. This can be to check if a display issue is caused by Serve Static or not. Or even, to speed test the uncached version of your site with compared of the cached version. Or even to check a change you've made in your site, without having to clear the cache.
                </br></br>Whatever your case might be, to just bypass the cache, simply add the <code>?noserve-static</code> query string to end of the URL. For example, to bypass Serve Static on your homepage, open the website in an incognito window, and use the following:
                </br><li><?php echo esc_url( get_site_url() ) ?>/?noserve-static</li>
                </br></br>Or for a specific page:  
                </br></br><li><?php echo esc_url( get_site_url() ) ?>/about-us/?noserve-static</li>
                </br></br>This should show you a version of your page, which is not served from the Serve-Static cache. If you find any issue, feel free to report it to me via the support forum, so that I can try releasing a fix for it.
                </p>
            </section>

            <section id="auto-flush-cache">
                <h2>What events can trigger auto-flushing of the HTML cache?</h2>
                <p>There are some events which cause the auto-flushing of the cache whenever certain actions happen, so that the latest content can get stored, and served from the cache. The actions that currently trigger the cache regenration are:</p>
                <ul><b>1. When someone posted a comment on a post, the cache of that page is automatically regenerated.</b></ul>
                <ul><b>2. When the page/post or any custom post type is updated from the WordPress Admin dashboard, the cache of that page is automatically regenerated.</b></ul>
                <ul><b>3. Whenever a rating has been added to your post/page or any custom post type. Currently, this plugin is integrated to work with ratings from <i>FeedbackWP, WP-PostRatings,</i> and <i>kkr Feedback plugin</i>.</b> If you are using any other rating plugins, kindly let me know in the support thread, so that I can add support for that as well.</ul>
                <p>As of now, these are the triggers that are set to auto-regenerate the cache for a specific page. If you have anything other in mind, or any other trigger you want me to add, let me know via the support forum, and I will try to add the trigger to that in the plugin.</p>
            </section>

            <section id="enable-functionality">
                <h2>Enable Plugin Functionality</h2>
                <p>This checkbox is is the master key of the plugin. The plugin will only function when this checkbox is checked. To troubleshoot issues, Just disable the option instead of deactivating the plugin..</p>
            </section>

            <section id="static-method">
                <h2>Static Method</h2>
                <p>This is the option where you can choose how to, and which content of your website to make static. There are three options currently,</p>
                <ul>1. Make All content static</ul>
                <ul>2. Make specific post types as static</ul>
                <ul>3. Make certain URLs static</ul>
            </section>

            <section id="all-static">
                <h2>Make all content as Static</h2>
                <p>Upon choosing this option, all the pages/posts/any custom post types will be made static. All the URLs in your website will be made Static, and will be served as HTML copies. You can exclude any certain URLs from the "Excluded URls" field.</p>
            </section>

            <section id="specific-post-types">
                <h2>Make specific post types Static</h2>
                <p>Enter the post type names to make static separated by commas. eg "post, page". You can also include the post type of any custom post types here. All the content of those post types will be made and served as Static. You can visit the Post Type page of a certain post type, and then find the post type name from it's urls. Check this screenshot out for help:</br></br>
                    <img src="<?php echo esc_url( plugin_dir_url( __DIR__ ) . '/assets/get-post-type.png' ) ?>" width='600' height='400'> 
                </br></br>Also, you can exclude certain URLs by adding the "Excluded URLs" option.</p>
            </section>

            <section id="enter-urls">
                <h2>Enter URLs manually to make them static</h2>
                <p>Enter the full URLs you want to make static. One in one line. eg: "<?php echo esc_url( get_site_url() ) ?>/my-page"</p>
            </section>

            <section id="minification">
                <h2>Minification</h2>
                <p><b>Enable HTML Minify</b> - Enable to Minify the cached HTML copy. this helps to both reduce the cache size, also to further improve the transfer size/time.</p>
                <p><b>Enable CSS Minify</b> - Enable to Minify the CSS of your Static webpages, and serve the minifed version of CSS. This also greatly helps to improve transfer size/time, and improve the overall performance. Disable this if you notice any errors.</p>
                <p><b>Enable JS Minify</b> - Enable to Minify the Javascript of your Static webpages, and serve the minified version to greatly imrpove the performance. I have tried my best to completely make it non-conflicting, but still if you find any errors, turn this option off.</p>
            </section>

            <section id="always-exclude-urls">
                <h2>Always Exclude URLs</h2>
                Enter the full URLs you want to exclude from making static. One in one line. eg: "<?php echo esc_url( get_site_url() ) ?>/my-page"</p>
            </section>

            <section id="interval-per-requests">
                <h2>Cache Warmup Requests Interval</h2>
                <p>The number of seconds you want to delay each WarmUp requests. Warmup requests use server resources, so one with a low config server might choose to go with a higher value, so that the server is not overloaded by reqesusts. Or else, it is okay to keep the value at 1, or just empty.</p>
            </section>

            <section id="fallback-method">
                <h2>Fallback method</h2>
                <p>By default, this plugin uses <i> .htaccess </i> modifications to serve the static HTMl files. This is the most recommended way, as this doesn't need to load WordPress core or files at all. But in any case, if in your server the <i> .htaccess </i> modifications are not working, or the static cache is not working properly on your frontend, you can enable this Fallback option. Enabling this option will result in using PHP to serve the Static cache, which means, WordPress files and Core will be loaded before the Static files are served. This may result in less performance optimization, still you will notice an positive impact on your loading speed. Yet, for the best performance, please get in touch with your hosting provider to check why the custom <i> .htaccess </i> rules are not working, or open a support thread in the Support Forum of this plugin. Please only use this as the last resort. </p>
            </section>

            <section id="cron-time">
                <h2>Cron Time</h2>
                <p>Select cron time to Flush and regenerate cache on a regular basis. The Static cache copies will be regenerated automatically after the interval you selected. When the cache copies are not available, your visitors will be served from the normal PHP processed pages. </p>
            </section>
        </div>
        <?php 
    }
}

$admin = new Admin();
add_action('admin_menu', array($admin, 'guide_sub_menu'));