<?php
function cielo_render_booking_form() {
    ?>
    <form id="cielo-booking-form">
        <label>Square Footage:</label>
        <input type="number" name="sqft" required />
        <label>Preferred Date:</label>
        <input type="date" name="appt_date" required />
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('cielo_booking_nonce'); ?>" />
        <button type="submit">Book Appointment</button>
    </form>
    <div id="cielo-response"></div>
    <?php
}