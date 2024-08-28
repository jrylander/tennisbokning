<?php

namespace cc\rylander\tennisbokning;

if ( is_admin() ) {
    add_action('admin_menu', __NAMESPACE__ . '\add_menu');
    add_action('admin_init', __NAMESPACE__ . '\register_settings');
}

function add_menu()
{
    add_options_page(
        'Tennisbokning Options',
        'Tennisbokning',
        'manage_options',
        'tennisbokning-options',
        __NAMESPACE__ . '\render_options'
    );
}

function register_settings()
{
    register_setting('tennisbokning_general', 'tennisbokning_name');
    register_setting('tennisbokning_general', 'tennisbokning_first_slot_time');
    register_setting('tennisbokning_general', 'tennisbokning_last_slot_time');
    register_setting('tennisbokning_general', 'tennisbokning_slot_length_minutes');
    register_setting('tennisbokning_general', 'tennisbokning_max_outstanding_bookings');
    register_setting('tennisbokning_general', 'tennisbokning_max_days_bookable');
}

function render_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    require_once dirname(__FILE__) . '/options.php';
}
