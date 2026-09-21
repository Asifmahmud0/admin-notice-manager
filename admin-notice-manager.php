<?php
/**
 * Plugin Name: Admin Notice Manager
 * Description: A Simple plugin to display custom notics in the WordPress dashboard
 * Version: 1.0.0
 * Author: Md Asif Ikbal
 * License: GPL v2 
 * Text Domain: admin-notice-manager
 */

// ( Security Best Practice ) 
 if ( ! defined( 'ABSPATH'  ) ) {
    exit;
 }


 /**
 * Display a custom notice in the admin area using the saved setting.
 */
function anm_display_custom_notice() {
    // Fetch the saved text from the database
    $notice_text = get_option( 'anm_notice_text', '' );

    // If there is no text saved, don't show the notice!
    if ( empty( $notice_text ) ) {
        return; 
    }

    ?>
    <div class="notice notice-success is-dismissible">
        <p>
            <strong><?php echo esc_html( $notice_text ); ?></strong>
        </p>
    </div>
    <?php
}
add_action( 'admin_notices', 'anm_display_custom_notice' );


/**
 * 1. Add a menu item under the "Settings" menu.
 */
function anm_add_settings_page() {
    add_options_page(
        'Admin Notice Manager Settings', // Page title (shows in the browser tab)
        'Notice Manager',                // Menu title (shows in the sidebar)
        'manage_options',                // Capability (only admins can see this)
        'admin-notice-manager',          // Menu slug (URL slug)
        'anm_render_settings_page'       // The function that displays the page HTML
    );
}
add_action( 'admin_menu', 'anm_add_settings_page' );

/**
 * 2. Register the setting in the database.
 */
function anm_register_settings() {
    // Register a setting named 'anm_notice_text'. 
    // 'sanitize_text_field' is a security measure to strip out malicious scripts.
    register_setting( 'anm_settings_group', 'anm_notice_text', 'sanitize_text_field' );
}
add_action( 'admin_init', 'anm_register_settings' );

/**
 * 3. Render the Settings Page HTML.
 */
function anm_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Admin Notice Manager</h1>
        <form method="post" action="options.php">
            <?php 
            // This outputs hidden security fields (nonces) necessary for WordPress to accept the save
            settings_fields( 'anm_settings_group' ); 
            
            // Get the current saved text from the database (or leave empty if not set yet)
            $current_text = get_option( 'anm_notice_text', '' );
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Custom Notice Text</th>
                    <td>
                        <input type="text" name="anm_notice_text" value="<?php echo esc_attr( $current_text ); ?>" class="regular-text" />
                        <p class="description">Type the message you want to show at the top of the dashboard.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}