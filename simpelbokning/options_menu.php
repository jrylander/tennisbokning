<?php

namespace cc\rylander\simpelbokning;

if ( is_admin() ) {
    add_action('admin_menu', __NAMESPACE__ . '\add_menu');
    add_action('admin_init', __NAMESPACE__ . '\register_settings');
}

function add_menu()
{
    add_options_page(
        __('Simpelbokning, inställningar', 'simpelbokning'),
        __('Simpel bokning', 'simpelbokning'),
        'manage_options',
        'simpelbokning-options',
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
        'simpelbokning_section',
        'Simpel bokning',
        __NAMESPACE__ . '\render_section',
        'simpelbokning'
    );
}

function render_section()
{
    echo 'Inställningar för Simpel bokning';
}

function add_settings() {
    register_setting('simpelbokning', 'simpelbokning_name', array('default' => __('Tennisbanan', 'simpelbokning'), 'sanitize_callback' => 'sanitize_text_field'));
    add_settings_field('simpelbokning_name', __('Namn på det som bokas', 'simpelbokning'), __NAMESPACE__ . '\render_name', 'simpelbokning', 'simpelbokning_section');

    register_setting('simpelbokning', 'simpelbokning_first_slot_time', array('default' => '08:00', 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_time'));
    add_settings_field('simpelbokning_first_slot_time', __('Första tid som kan bokas', 'simpelbokning'), __NAMESPACE__ . '\render_first_slot_time', 'simpelbokning', 'simpelbokning_section');

    register_setting('simpelbokning', 'simpelbokning_last_slot_time', array('default' => '17:00', 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_time'));
    add_settings_field('simpelbokning_last_slot_time', __('Sista tid som kan bokas', 'simpelbokning'), __NAMESPACE__ . '\render_last_slot_time', 'simpelbokning', 'simpelbokning_section');

    register_setting('simpelbokning', 'simpelbokning_slot_length_minutes', array('default' => 1, 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_positive_integer'));
    add_settings_field('simpelbokning_slot_length_minutes', __('Bokningslängd i minuter', 'simpelbokning'), __NAMESPACE__ . '\render_slot_length_minutes', 'simpelbokning', 'simpelbokning_section');

    register_setting('simpelbokning', 'simpelbokning_max_outstanding_bookings', array('default' => 2, 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_positive_integer'));
    add_settings_field('simpelbokning_max_outstanding_bookings', __('Max antal aktiva bokningar per användare', 'simpelbokning'), __NAMESPACE__ . '\render_max_outstanding_bookings', 'simpelbokning', 'simpelbokning_section');

    register_setting('simpelbokning', 'simpelbokning_max_days_bookable', array('default' => 14, 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_positive_integer'));
    add_settings_field('simpelbokning_max_days_bookable', __('Max antal dagar framåt som kan bokas', 'simpelbokning'), __NAMESPACE__ . '\render_max_days_bookable', 'simpelbokning', 'simpelbokning_section');
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
    $name = get_option('simpelbokning_name');
    echo "<input type='text' name='simpelbokning_name' value='$name' />";
}

function render_first_slot_time()
{
    $first_slot_time = get_option('simpelbokning_first_slot_time');
    echo "<input type='time' name='simpelbokning_first_slot_time' value='$first_slot_time' />";
}

function render_last_slot_time()
{
    $last_slot_time = get_option('simpelbokning_last_slot_time');
    echo "<input type='time' name='simpelbokning_last_slot_time' value='$last_slot_time' />";
}

function render_slot_length_minutes()
{
    $slot_length_minutes = get_option('simpelbokning_slot_length_minutes');
    echo "<input type='number' name='simpelbokning_slot_length_minutes' value='$slot_length_minutes' />";
}

function render_max_outstanding_bookings()
{
    $max_outstanding_bookings = get_option('simpelbokning_max_outstanding_bookings');
    echo "<input type='number' name='simpelbokning_max_outstanding_bookings' value='$max_outstanding_bookings' />";
}

function render_max_days_bookable()
{
    $max_days_bookable = get_option('simpelbokning_max_days_bookable');
    echo "<input type='number' name='simpelbokning_max_days_bookable' value='$max_days_bookable' />";
}

function render_options_page()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    require_once dirname(__FILE__) . '/options.php';
}
