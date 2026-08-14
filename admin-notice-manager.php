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


 // Display a Custom Notice In  The Admin Area

function anm_display_custom_notice( ) {

    ?>
            <div class=" notice notice-sucess is-dismissble">
                <p>  
                    <strong><?php  esc_html_e( 'Hello! This is your custom Admin Notice Manaer is working' , 'admin-notice-manager'); ?> 

                    </strong>
                </p>

            </div>
    <?php
}
add_action( 'admin_notices', 'anm_display_custom_notice' );