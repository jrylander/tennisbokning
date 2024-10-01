<?php

namespace cc\rylander\simpelbokning;

function current_bookings()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'simpelbokning_bookings';

    $query = $wpdb->prepare("SELECT time, length_minutes, name FROM $table_name WHERE time BETWEEN NOW() AND NOW() + INTERVAL %d WEEK;", \get_option('simpelbokning_weeks_to_show'));
    $current_bookings = $wpdb->get_results($query);

    $first_slot_hour = \get_option('simpelbokning_first_slot_hour');
    $last_slot_hour = \get_option('simpelbokning_last_slot_hour');
    $now = new \DateTimeImmutable();
    $this_week = $now->format('W');
    $year = $now->format('Y');

    ob_start();
    require_once dirname(__FILE__) . '/current_bookings_view.php';
    return ob_get_clean();
}
