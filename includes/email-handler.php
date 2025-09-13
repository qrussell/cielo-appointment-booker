<?php
function cielo_send_confirmation_email($email, $appt_id, $date, $price) {
    $confirm_url = add_query_arg(['cielo_action' => 'confirm', 'appt_id' => $appt_id], site_url());
    $cancel_url = add_query_arg(['cielo_action' => 'cancel', 'appt_id' => $appt_id], site_url());
    $reschedule_url = add_query_arg(['cielo_action' => 'reschedule', 'appt_id' => $appt_id], site_url());

    $message = "You've requested an appointment on $date for \$$price.\n\n";
    $message .= "✅ Confirm: $confirm_url\n❌ Cancel: $cancel_url\n🔄 Reschedule: $reschedule_url\n";

    wp_mail($email, 'Confirm Your Appointment', $message);
}

add_action('init', function() {
    if (!isset($_GET['cielo_action'], $_GET['appt_id'])) return;

    $user_id = get_current_user_id();
    $appt_id = sanitize_text_field($_GET['appt_id']);
    $action = sanitize_text_field($_GET['cielo_action']);

    if ($action === 'confirm') {
        update_user_meta($user_id, $appt_id . '_status', 'confirmed');
        cielo_create_google_event($user_id, $appt_id);
        cielo_create_admin_event($appt_id);
        wp_redirect(site_url('/thank-you/?status=confirmed'));
        exit;
    } elseif ($action === 'cancel') {
        delete_user_meta($user_id, $appt_id);
        wp_redirect(site_url('/thank-you/?status=cancelled'));
        exit;
    } elseif ($action === 'reschedule') {
        wp_redirect(site_url('/reschedule/?appt_id=' . $appt_id));
        exit;
    }
});