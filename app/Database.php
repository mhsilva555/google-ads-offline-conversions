<?php

namespace App\GoogleOffline;

class Database
{
    public static function create($database)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . $database;

        $check_table = $wpdb->get_var("SHOW TABLES LIKE '{$table_name}'");

        if($check_table == $table_name) {
            return;
        }

        $sql = "CREATE TABLE {$table_name} (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        gclid varchar(255) NOT NULL,
        event varchar(100) NOT NULL,
        time DATETIME DEFAULT NOW() NULL,
        ip varchar(255) NULL,
        code_area varchar(3) NULL,
        city varchar(100) NULL,
        state varchar(3) NULL,
        PRIMARY KEY  (id)
        );";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function save()
    {
    }
}