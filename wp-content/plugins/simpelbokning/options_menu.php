<?php

namespace cc\rylander\simpelbokning;

if ( is_admin() ) {
    add_action('admin_menu', __NAMESPACE__ . '\add_menu');
    add_action('admin_init', __NAMESPACE__ . '\register_settings');
}

function add_menu(): void {
    add_options_page(
        __('Settings for Simple booking', 'simpelbokning'),
        __('Simple booking', 'simpelbokning'),
        'manage_options',
        'simpelbokning-options',
        __NAMESPACE__ . '\render_options_page'
    );
}

function register_settings(): void {
    add_sections();
    add_settings();
}

function add_sections(): void {
    add_settings_section(
        'simpelbokning_rules_section',
        __('Rules', 'simpelbokning'),
        __NAMESPACE__ . '\render_section',
        'simpelbokning'
    );
    add_settings_section(
        'simpelbokning_paths_section',
        __('Pages', 'simpelbokning'),
        __NAMESPACE__ . '\render_section',
        'simpelbokning'
    );
}

function render_section(): void {
    echo '';
}

function add_settings(): void {
    // Rules
    register_setting('simpelbokning', 'simpelbokning_name', array('default' => __('Tennis court', 'simpelbokning'), 'sanitize_callback' => 'sanitize_text_field'));
    add_settings_field('simpelbokning_name', __('Name of the resource of the booking system', 'simpelbokning'), __NAMESPACE__ . '\render_name', 'simpelbokning', 'simpelbokning_rules_section');

    register_setting('simpelbokning', 'simpelbokning_first_slot_hour', array('default' => 8, 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_first_slot_hour'));
    add_settings_field('simpelbokning_first_slot_hour', __('First timeslot (hour)', 'simpelbokning'), __NAMESPACE__ . '\render_first_slot_hour', 'simpelbokning', 'simpelbokning_rules_section');

    register_setting('simpelbokning', 'simpelbokning_last_slot_hour', array('default' => 17, 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_last_slot_hour'));
    add_settings_field('simpelbokning_last_slot_hour', __('Last timeslot (hour)', 'simpelbokning'), __NAMESPACE__ . '\render_last_slot_hour', 'simpelbokning', 'simpelbokning_rules_section');

    register_setting('simpelbokning', 'simpelbokning_slot_length_minutes', array('default' => 60, 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_slot_length_minutes'));
    add_settings_field('simpelbokning_slot_length_minutes', __('Length of timeslots in minutes', 'simpelbokning'), __NAMESPACE__ . '\render_slot_length_minutes', 'simpelbokning', 'simpelbokning_rules_section');

    register_setting('simpelbokning', 'simpelbokning_max_outstanding_bookings', array('default' => 2, 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_max_outstanding_bookings'));
    add_settings_field('simpelbokning_max_outstanding_bookings', __('Max number of active bookings per user', 'simpelbokning'), __NAMESPACE__ . '\render_max_outstanding_bookings', 'simpelbokning', 'simpelbokning_rules_section');

    register_setting('simpelbokning', 'simpelbokning_max_days_bookable', array('default' => 14, 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_max_days_bookable'));
    add_settings_field('simpelbokning_max_days_bookable', __('Max number of days in the future that can be booked', 'simpelbokning'), __NAMESPACE__ . '\render_max_days_bookable', 'simpelbokning', 'simpelbokning_rules_section');

    register_setting('simpelbokning', 'simpelbokning_weeks_to_show', array('default' => 2, 'sanitize_callback' =>  __NAMESPACE__ . '\sanitize_weeks_to_show'));
    add_settings_field('simpelbokning_weeks_to_show', __('Number of weeks in the future to show for visitors', 'simpelbokning'), __NAMESPACE__ . '\render_weeks_to_show', 'simpelbokning', 'simpelbokning_rules_section');

    // Paths
    register_setting('simpelbokning', 'simpelbokning_path_for_booking_form', array('default' => '/book', 'sanitize_callback' =>  'sanitize_text_field'));
    add_settings_field('simpelbokning_path_for_booking_form', __('Address of booking form', 'simpelbokning'), __NAMESPACE__ . '\render_path_for_booking_form', 'simpelbokning', 'simpelbokning_paths_section');

    register_setting('simpelbokning', 'simpelbokning_path_for_booking_request', array('default' => '/book-request', 'sanitize_callback' =>  'sanitize_text_field'));
    add_settings_field('simpelbokning_path_for_booking_request', __('Address of page that displays reminder about confirming booking with link in email', 'simpelbokning'), __NAMESPACE__ . '\render_path_for_booking_request', 'simpelbokning', 'simpelbokning_paths_section');

    register_setting('simpelbokning', 'simpelbokning_path_for_booking_confirmation', array('default' => '/book-confirm', 'sanitize_callback' =>  'sanitize_text_field'));
    add_settings_field('simpelbokning_path_for_booking_confirmation', __('Address of booking confirmation form', 'simpelbokning'), __NAMESPACE__ . '\render_path_for_booking_confirmation', 'simpelbokning', 'simpelbokning_paths_section');

    register_setting('simpelbokning', 'simpelbokning_path_for_booking_done', array('default' => '/book-done', 'sanitize_callback' =>  'sanitize_text_field'));
    add_settings_field('simpelbokning_path_for_booking_done', __('Address of page that is shown when booking is done', 'simpelbokning'), __NAMESPACE__ . '\render_path_for_booking_done', 'simpelbokning', 'simpelbokning_paths_section');

    register_setting('simpelbokning', 'simpelbokning_path_for_booking_error', array('default' => '/book-error', 'sanitize_callback' =>  'sanitize_text_field'));
    add_settings_field('simpelbokning_path_for_booking_error', __('Address of page to show when booking cannot be done', 'simpelbokning'), __NAMESPACE__ . '\render_path_for_booking_error', 'simpelbokning', 'simpelbokning_paths_section');
}

function sanitize_first_slot_hour($input) {
    $old_value = get_option('simpelbokning_first_slot_hour');
    $last_slot_hour = get_option('simpelbokning_last_slot_hour');
    if ($input > 0 && $input <= 23 && $input <= $last_slot_hour && $last_slot_hour >= 0) {
        return $input;
    }
    add_settings_error('simpelbokning_first_slot_hour', 'invalid-number', __('First slot hour must be between 0 and 23 and not greater than last slot time', 'simpelbokning'));
    return $old_value;
}

function sanitize_last_slot_hour($input) {
    $old_value = get_option('simpelbokning_last_slot_hour');
    $first_slot_hour = get_option('simpelbokning_first_slot_hour');
    if ($input > 0 && $input <= 23 && $input >= $first_slot_hour && $first_slot_hour >= 0) {
        return $input;
    }
    add_settings_error('simpelbokning_last_slot_hour', 'invalid-number', __('Last slot hour must be between 0 and 23 and not less than first slot time', 'simpelbokning'));
    return $old_value;
}

function sanitize_max_outstanding_bookings($input) {
    $old_value = get_option('simpelbokning_max_outstanding_bookings');
    if ($input > 0) {
        return $input;
    }
    add_settings_error('simpelbokning_max_outstanding_bookings', 'invalid-number', __('Max number of active bookings per user must be greater than 1', 'simpelbokning'));
    return $old_value;
}

function sanitize_max_days_bookable($input) {
    $old_value = get_option('simpelbokning_max_days_bookable');
    if ($input > 0) {
        return $input;
    }
    add_settings_error('simpelbokning_max_days_bookable', 'invalid-number', __('Max number of days in the future that can be booked must be greater than 1', 'simpelbokning'));
    return $old_value;
}

function sanitize_slot_length_minutes($input) {
    $old_value = get_option('simpelbokning_slot_length_minutes');
    if ($input > 0 && $input <= 1440) {
        return $input;
    }
    add_settings_error('simpelbokning_slot_length_minutes', 'invalid-number', __('Length of timeslots in minutes must be between 1 and 1440', 'simpelbokning'));
    return $old_value;
}

function sanitize_weeks_to_show($input) {
    $old_value = get_option('simpelbokning_weeks_to_show');
    if ($input > 0) {
        return $input;
    }
    add_settings_error('simpelbokning_weeks_to_show', 'invalid-number', __('Number of weeks to show must be at least 1', 'simpelbokning'));
    return $old_value;
}

function render_name(): void {
    $name = get_option('simpelbokning_name');
    echo "<input type='text' name='simpelbokning_name' value='$name' />";
}

function render_first_slot_hour(): void {
    $first_slot_hour = get_option('simpelbokning_first_slot_hour');
    echo "<input type='number' name='simpelbokning_first_slot_hour' value='$first_slot_hour' />";
}

function render_last_slot_hour(): void {
    $last_slot_hour = get_option('simpelbokning_last_slot_hour');
    echo "<input type='number' name='simpelbokning_last_slot_hour' value='$last_slot_hour' />";
}

function render_slot_length_minutes(): void {
    $slot_length_minutes = get_option('simpelbokning_slot_length_minutes');
    echo "<input type='number' name='simpelbokning_slot_length_minutes' value='$slot_length_minutes' />";
}

function render_max_outstanding_bookings(): void {
    $max_outstanding_bookings = get_option('simpelbokning_max_outstanding_bookings');
    echo "<input type='number' name='simpelbokning_max_outstanding_bookings' value='$max_outstanding_bookings' />";
}

function render_max_days_bookable(): void {
    $max_days_bookable = get_option('simpelbokning_max_days_bookable');
    echo "<input type='number' name='simpelbokning_max_days_bookable' value='$max_days_bookable' />";
}

function render_weeks_to_show(): void {
    $weeks_to_show = get_option('simpelbokning_weeks_to_show');
    echo "<input type='number' name='simpelbokning_weeks_to_show' value='$weeks_to_show' />";
}

function render_path_for_booking_form(): void {
    $path_for_booking_form = get_option('simpelbokning_path_for_booking_form');
    echo "<input type='text' name='simpelbokning_path_for_booking_form' value='$path_for_booking_form' />";
}

function render_path_for_booking_request(): void {
    $path_for_booking_request = get_option('simpelbokning_path_for_booking_request');
    echo "<input type='text' name='simpelbokning_path_for_booking_request' value='$path_for_booking_request' />";
}

function render_path_for_booking_confirmation(): void {
    $path_for_booking_confirmation = get_option('simpelbokning_path_for_booking_confirmation');
    echo "<input type='text' name='simpelbokning_path_for_booking_confirmation' value='$path_for_booking_confirmation' />";
}

function render_path_for_booking_done(): void {
    $path_for_booking_done = get_option('simpelbokning_path_for_booking_done');
    echo "<input type='text' name='simpelbokning_path_for_booking_done' value='$path_for_booking_done' />";
}

function render_path_for_booking_error(): void {
    $path_for_booking_error = get_option('simpelbokning_path_for_booking_error');
    echo "<input type='text' name='simpelbokning_path_for_booking_error' value='$path_for_booking_error' />";
}

function render_options_page(): void {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    require_once dirname(__FILE__) . '/options_view.php';
}
