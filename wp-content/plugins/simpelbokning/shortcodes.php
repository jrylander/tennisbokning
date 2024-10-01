<?php

namespace cc\rylander\simpelbokning;

require_once dirname(__FILE__) . '/current_bookings/current_bookings_controller.php';
require_once dirname(__FILE__) . '/booking_form/booking_form_controller.php';
require_once dirname(__FILE__) . '/booking_info/booking_info_controller.php';
require_once dirname(__FILE__) . '/booking_confirmation_form/booking_confirmation_form_controller.php';

add_action('init', __NAMESPACE__ . '\register_shortcodes');

function register_shortcodes(): void {
    add_shortcode('simpelbokning_current_bookings', __NAMESPACE__ . '\current_bookings');
    add_shortcode('simpelbokning_booking_form', __NAMESPACE__ . '\booking_form');
    add_shortcode('simpelbokning_booking_info', __NAMESPACE__ . '\booking_info');
    add_shortcode('simpelbokning_booking_confirmation_form', __NAMESPACE__ . '\booking_confirmation_form');
}
