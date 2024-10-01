<?php

namespace cc\rylander\simpelbokning;

add_action( 'admin_init', __NAMESPACE__ . '\db_install' );

function db_install()
{
    $db_version = '0.13';

    $version_setting = __NAMESPACE__ . '\db_version';
    $installed_version = get_option($version_setting);

    error_log('Database version: ' . $installed_version . ' vs ' . $db_version);

    if ($installed_version != $db_version) {

        error_log('Uppgrading database');

        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $bookings_table = $wpdb->prefix . "simpelbokning_bookings";

        $sql = "CREATE TABLE $bookings_table (\n
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,\n
        time DATETIME NOT NULL,\n
        length_hours TINYINT UNSIGNED NOT NULL,\n
        email TINYTEXT NOT NULL,\n
        name TINYTEXT NOT NULL,\n
        hashed_password CHAR(32) NOT NULL,\n
        PRIMARY KEY (id)\n
      ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);

        update_option(__NAMESPACE__ . '\db_version', $db_version);
    }
}
