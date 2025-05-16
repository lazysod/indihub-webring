<?php
/*
Plugin Name: IndiHub Webring
Plugin URI: https://github.com/lazysod/indihub-webring
Description: A webring navigation plugin for WordPress.
Version: 1.1
Author: Lazysod
Author URI: https://theindihub.org
GitHub Plugin URI: https://github.com/lazysod/indihub-webring
*/

// Register Settings for User ID, Site ID, and Token
function indihub_webring_settings() {
    register_setting('indihub_webring', 'indihub_user_id');
    register_setting('indihub_webring', 'indihub_site_id');
    register_setting('indihub_webring', 'indihub_token');
}
add_action('admin_init', 'indihub_webring_settings');

// Add settings menu
function indihub_webring_menu() {
    add_options_page(
        'IndiHub Webring Settings',
        'IndiHub Webring',
        'manage_options',
        'indihub-webring',
        'indihub_webring_settings_page'
    );
}
add_action('admin_menu', 'indihub_webring_menu');

// Create settings page content
function indihub_webring_settings_page() {
    ?>
    <div class="wrap">
        <h1>IndiHub Webring Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('indihub_webring');
            do_settings_sections('indihub_webring');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">User ID</th>
                    <td><input type="text" name="indihub_user_id" value="<?php echo esc_attr(get_option('indihub_user_id')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Site ID</th>
                    <td><input type="text" name="indihub_site_id" value="<?php echo esc_attr(get_option('indihub_site_id')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Token</th>
                    <td><input type="text" name="indihub_token" value="<?php echo esc_attr(get_option('indihub_token')); ?>" /></td>
                </tr>
            </table>
            <?php
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Shortcode for Webring Display
function indihub_webring_shortcode($atts) {
    $user_id = get_option('indihub_user_id');
    $site_id = get_option('indihub_site_id');
    $token = get_option('indihub_token');
    $js_last_update = get_option('indihub_webring_last_update', time());

    if (!$user_id || !$site_id || !$token) {
        return '<p>Please configure your webring settings in the admin panel.</p>';
    }

    return '<script src="https://cdn.theindihub.org/js/webring.js?v=' . $js_last_update . '" data-user="' . esc_attr($user_id) . '" data-site="' . esc_attr($site_id) . '" data-token="' . esc_attr($token) . '"></script>';
}
add_shortcode('indihub_webring', 'indihub_webring_shortcode');

// Function to Check for JS Updates
function indihub_check_js_update() {
    $url = "https://cdn.theindihub.org/js/webring.js";
    $response = wp_remote_head($url);

    if (is_wp_error($response)) return;

    $headers = wp_remote_retrieve_headers($response);
    if (!empty($headers['last-modified'])) {
        $last_update = strtotime($headers['last-modified']);
        update_option('indihub_webring_last_update', $last_update);
    }
}
add_action('admin_init', 'indihub_check_js_update');

// Notify Users If JS File Has Updated
function indihub_notify_js_update() {
    $last_update = get_option('indihub_webring_last_update', 0);
    $current_update = get_option('indihub_webring_last_update');

    if ($current_update > $last_update) {
        echo "<div class='notice notice-warning'><p>IndiHub Webring has been updated! Your site is now using the latest version.</p></div>";
        update_option('indihub_webring_last_update', $current_update);
    }
}
add_action('admin_notices', 'indihub_notify_js_update');
