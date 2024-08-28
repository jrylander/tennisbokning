<?php

namespace cc\rylander\tennisbokning;

add_action( 'plugins_loaded', __NAMESPACE__ . '\db_install' );

function db_install()
{
    $db_version = '0.9';

    $version_setting = __NAMESPACE__ . 'db_version';
    $installed_version = get_option($version_setting);

    if ($installed_version != $db_version) {

        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $bookings_table = $wpdb->prefix . "tennisbokning_bookings";

        $sql = "CREATE TABLE $bookings_table (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        time DATETIME NOT NULL,
        length_minutes TINYINT UNSIGNED NOT NULL,
        email TINYTEXT NOT NULL,
        name TINYTEXT NOT NULL,
        PRIMARY KEY  (id)
      ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);

        add_option(__NAMESPACE__ . 'db_version', $db_version);
    }
}
