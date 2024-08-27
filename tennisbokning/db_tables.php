<?php

namespace cc\rylander\tennisbokning;

require_once ABSPATH . 'wp-admin/includes/upgrade.php';

global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

$settings_table = $wpdb->prefix . "tennisbokning_settings";

$sql = "CREATE TABLE $settings_table (
    name TINYTEXT NOT NULL,
    from_time TIME NOT NULL,
    to_time TIME NOT NULL,
    max_bookings INT NOT NULL,
    max_future_days INT NOT NULL
) $charset_collate;";

dbDelta($sql);

$bookings_table = $wpdb->prefix . "tennisbokning_bookings";

$sql = "CREATE TABLE $bookings_table (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    time DATETIME NOT NULL,
    email TINYTEXT NOT NULL,
    name TINYTEXT NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";

dbDelta($sql);
