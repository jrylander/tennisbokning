<?php

namespace cc\rylander\tennisbokning;

function tennisbokning_menu()
{
    add_options_page(
        'Tennisbokning Options',
        'Tennisbokning',
        'manage_options',
        'tennisbokning-options',
        __NAMESPACE__ . '\tennisbokning_options'
    );
}

function tennisbokning_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    echo '<div class="wrap">';
    echo '<p>Here is where the form would go if I actually had options.</p>';
    echo '</div>';
}

add_action('admin_menu', __NAMESPACE__ . '\tennisbokning_menu');
