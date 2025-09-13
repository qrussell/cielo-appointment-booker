<?php
function cielo_schedule_reminder($user_id, $appt_id, $date) {
    $timestamp = strtotime($date . ' -1 day');
    wp_schedule_single_event($timestamp, 'cielo_send_reminder', [$user_id, $appt_id]);
}

add_action('cielo_send_reminder', function($user_id, $appt_id) {
    $email = get_userdata($user_id)->user_email;
    wp_mail($email, 'Appointment Reminder', 'Your appointment is tomorrow!');
});