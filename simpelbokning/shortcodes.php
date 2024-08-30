<?php

namespace cc\rylander\simpelbokning;

add_action('init', __NAMESPACE__ . '\register_shortcodes');

function register_shortcodes()
{
    add_shortcode('simpelbokning_current_bookings', __NAMESPACE__ . '\current_bookings');
}

function current_bookings()
{
    require_once dirname(__FILE__) . '/views/current_bookings.php';
}
