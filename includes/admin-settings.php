<?php
function cielo_register_settings() {
    register_setting('cielo_options_group', 'cielo_rate_per_sqft', ['type' => 'string', 'sanitize_callback' => 'sanitize_text_field']);
    register_setting('cielo_options_group', 'cielo_google_client_id');
    register_setting('cielo_options_group', 'cielo_google_client_secret');
    register_setting('cielo_options_group', 'cielo_google_access_token');

    add_settings_section('cielo_main_section', 'Appointment Settings', null, 'cielo');
    add_settings_field('rate_per_sqft', 'Rate per Square Foot', 'cielo_rate_field', 'cielo', 'cielo_main_section');
}
add_action('admin_init', 'cielo_register_settings');

function cielo_rate_field() {
    $value = esc_attr(get_option('cielo_rate_per_sqft', '0.10'));
    echo "<input type='text' name='cielo_rate_per_sqft' value='$value' />";
}

function cielo_plugin_menu() {
    add_menu_page('Cielo Appointments', 'Appointments', 'manage_options', 'cielo', 'cielo_settings_page');
}
add_action('admin_menu', 'cielo_plugin_menu');

function cielo_settings_page() {
    ?>
    <form method="post" action="options.php">
        <?php settings_fields('cielo_options_group'); ?>
        <?php do_settings_sections('cielo'); ?>
        <?php submit_button(); ?>
    </form>
    <?php
}