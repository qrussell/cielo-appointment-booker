<?php
/**
 * Plugin Name: Cielo Appointment Booker
 * Description: Appointment booking with WooCommerce, Google Calendar sync, AJAX, and Divi integration.
 * Version: 2.0
 * Author: Cielo Cloud Host
 */

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/booking-form.php';
require_once plugin_dir_path(__FILE__) . 'includes/email-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/calendar-sync.php';
require_once plugin_dir_path(__FILE__) . 'includes/ajax-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/reminder-scheduler.php';
require_once plugin_dir_path(__FILE__) . 'includes/divi-module.php';

// Shortcode fallback
function cielo_booking_shortcode() {
    ob_start();
    cielo_render_booking_form();
    return ob_get_clean();
}
add_shortcode('cielo_booking_form', 'cielo_booking_shortcode');