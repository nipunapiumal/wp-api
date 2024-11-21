<?php
/*
Plugin Name: Redirect Login Users - Nipuna
Description: Redirects logged-in users to a custom page after login, configurable via a settings page.
Version: 1.0
Author: Nipuna Pathirana
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Create a settings page in the WordPress admin
function rlu_add_settings_page() {
    add_options_page(
        'Redirect Login Settings',
        'Redirect Login',
        'manage_options',
        'redirect-login-settings',
        'rlu_settings_page_html'
    );
}
add_action( 'admin_menu', 'rlu_add_settings_page' );

// Render the settings page HTML
function rlu_settings_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Handle form submission
    if ( isset( $_POST['rlu_redirect_url'] ) ) {
        check_admin_referer( 'rlu_save_settings' ); // Security check
        update_option( 'rlu_redirect_url', sanitize_text_field( $_POST['rlu_redirect_url'] ) );
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }

    // Get the current redirect URL
    $redirect_url = get_option( 'rlu_redirect_url', home_url() );

    ?>
    <div class="wrap">
        <h1>Redirect Login Settings - Nipuna</h1>
        <form method="post" action="">
            <?php wp_nonce_field( 'rlu_save_settings' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="rlu_redirect_url">Redirect URL after login</label></th>
                    <td>
                        <input type="url" id="rlu_redirect_url" name="rlu_redirect_url" value="<?php echo esc_attr( $redirect_url ); ?>" class="regular-text" required>
                        <p class="description">Enter the URL to redirect users after login. For example: <code><?php echo home_url( '/your-page/' ); ?></code></p>
                    </td>
                </tr>
            </table>
            <?php submit_button( 'Save Changes' ); ?>
        </form>
    </div>
    <?php
}

// Redirect users after login
function rlu_redirect_after_login( $redirect_to, $request, $user ) {
    // Only redirect non-admin users
    if ( isset( $user->roles ) &&  in_array( 'subscriber', $user->roles ) ) {
        $custom_redirect = get_option( 'rlu_redirect_url', home_url() );
        return $custom_redirect;
    }

    // Default redirect for admin users
    return $redirect_to;
}
add_filter( 'login_redirect', 'rlu_redirect_after_login', 10, 3 );
