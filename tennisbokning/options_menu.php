<?php

namespace cc\rylander\tennisbokning;

if ( is_admin() ) {
    add_action('admin_menu', __NAMESPACE__ . '\add_menu');
    add_action('admin_init', __NAMESPACE__ . '\register_settings');
}

function add_menu()
{
    add_options_page(
        __('Tennisbokning-inställningar', 'tennisbokning'),
        __('Tennisbokning', 'tennisbokning'),
        'manage_options',
        'tennisbokning-options',
        __NAMESPACE__ . '\render_options_page'
    );
}

function register_settings()
{
    add_section();
    add_settings();
}

function add_section() {
    add_settings_section(
        'tennisbokning_section',
        'Tennisbokning',
        __NAMESPACE__ . '\render_section',
        'tennisbokning'
    );
}

function render_section()
{
    echo 'Här kan du ställa in hur tennisbokningen ska fungera';
}

function add_settings() {
    register_setting('tennisbokning', 'tennisbokning_name', array('sanitize_callback' => 'sanitize_text_field'));
    add_settings_field('tennisbokning_name', __('Namn på det som bokas', 'tennisbokning'), __NAMESPACE__ . '\render_name', 'tennisbokning', 'tennisbokning_section');

    register_setting('tennisbokning', 'tennisbokning_first_slot_time', array('sanitize_callback' =>  __NAMESPACE__ . '\sanitize_time'));
    add_settings_field('tennisbokning_first_slot_time', __('Första tid som kan bokas', 'tennisbokning'), __NAMESPACE__ . '\render_first_slot_time', 'tennisbokning', 'tennisbokning_section');

    register_setting('tennisbokning', 'tennisbokning_last_slot_time', array('sanitize_callback' =>  __NAMESPACE__ . '\sanitize_time'));
    add_settings_field('tennisbokning_last_slot_time', __('Sista tid som kan bokas', 'tennisbokning'), __NAMESPACE__ . '\render_last_slot_time', 'tennisbokning', 'tennisbokning_section');

    register_setting('tennisbokning', 'tennisbokning_slot_length_minutes', array('sanitize_callback' =>  __NAMESPACE__ . '\sanitize_positive_integer'));
    add_settings_field('tennisbokning_slot_length_minutes', __('Bokningslängd i minuter', 'tennisbokning'), __NAMESPACE__ . '\render_slot_length_minutes', 'tennisbokning', 'tennisbokning_section');

    register_setting('tennisbokning', 'tennisbokning_max_outstanding_bookings', array('sanitize_callback' =>  __NAMESPACE__ . '\sanitize_positive_integer'));
    add_settings_field('tennisbokning_max_outstanding_bookings', __('Max antal aktiva bokningar per användare', 'tennisbokning'), __NAMESPACE__ . '\render_max_outstanding_bookings', 'tennisbokning', 'tennisbokning_section');

    register_setting('tennisbokning', 'tennisbokning_max_days_bookable', array('sanitize_callback' =>  __NAMESPACE__ . '\sanitize_positive_integer'));
    add_settings_field('tennisbokning_max_days_bookable', __('Max antal dagar framåt som kan bokas', 'tennisbokning'), __NAMESPACE__ . '\render_max_days_bookable', 'tennisbokning', 'tennisbokning_section');
}

function sanitize_time($input) {
    if (preg_match('/^([01][0-9]|2[0-3]):[0-5][0-9]$/', $input)) {
        return $input;
    }
    return "";
}

function sanitize_positive_integer($input) {
    if (preg_match('/^[1-9][0-9]*$/', $input)) {
        return $input;
    }
    return "";
}

function render_name()
{
    $name = get_option('tennisbokning_name');
    echo "<input type='text' name='tennisbokning_name' value='$name' />";
}

function render_first_slot_time()
{
    $first_slot_time = get_option('tennisbokning_first_slot_time');
    echo "<input type='time' name='tennisbokning_first_slot_time' value='$first_slot_time' />";
}

function render_last_slot_time()
{
    $last_slot_time = get_option('tennisbokning_last_slot_time');
    echo "<input type='time' name='tennisbokning_last_slot_time' value='$last_slot_time' />";
}

function render_slot_length_minutes()
{
    $slot_length_minutes = get_option('tennisbokning_slot_length_minutes');
    echo "<input type='number' name='tennisbokning_slot_length_minutes' value='$slot_length_minutes' />";
}

function render_max_outstanding_bookings()
{
    $max_outstanding_bookings = get_option('tennisbokning_max_outstanding_bookings');
    echo "<input type='number' name='tennisbokning_max_outstanding_bookings' value='$max_outstanding_bookings' />";
}

function render_max_days_bookable()
{
    $max_days_bookable = get_option('tennisbokning_max_days_bookable');
    echo "<input type='number' name='tennisbokning_max_days_bookable' value='$max_days_bookable' />";
}

function render_options_page()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    require_once dirname(__FILE__) . '/options.php';
}
