<?php
add_action('wp_ajax_cielo_book_appointment', 'cielo_ajax_handler');
add_action('wp_ajax_nopriv_cielo_book_appointment', 'cielo_ajax_handler');

function cielo_ajax_handler() {
    check_ajax_referer('cielo_booking_nonce', 'nonce');

    $user = wp_get_current_user();
    if (!$user->exists()) {
        wp_send_json_error('User not logged in');
    }

    $sqft = intval($_POST['sqft']);
    $date = sanitize_text_field($_POST['appt_date']);
    $rate = floatval(get_option('cielo_rate_per_sqft', '0.10'));
    $price = $rate * $sqft;
    $appt_id = uniqid('appt_');

    update_user_meta($user->ID, $appt_id, ['sqft' => $sqft, 'date' => $date, 'price' => $price]);
    cielo_send_confirmation_email($user->user_email, $appt_id, $date, $price);
    cielo_schedule_reminder($user->ID, $appt_id, $date);

    wp_send_json_success('Appointment booked! Check your email to confirm.');
}