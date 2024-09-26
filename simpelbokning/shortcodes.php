<?php

namespace cc\rylander\simpelbokning;

require_once dirname(__FILE__) . '/current_bookings/current_bookings_controller.php';
require_once dirname(__FILE__) . '/new_booking/new_booking_controller.php';

add_action('init', __NAMESPACE__ . '\register_shortcodes');

function register_shortcodes()
{
    add_shortcode('simpelbokning_current_bookings', __NAMESPACE__ . '\current_bookings');
    add_shortcode('simpelbokning_new_booking', __NAMESPACE__ . '\new_booking');
}
