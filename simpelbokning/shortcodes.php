<?php

namespace cc\rylander\simpelbokning;

require_once dirname(__FILE__) . '/current_bookings/current_bookings_controller.php';

add_action('init', __NAMESPACE__ . '\register_shortcodes');

function register_shortcodes()
{
    add_shortcode('simpelbokning_current_bookings', __NAMESPACE__ . '\current_bookings');
}
