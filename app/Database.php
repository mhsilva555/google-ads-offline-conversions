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
        PRIMARY KEY  (id)
        );";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function save()
    {
        global $attributes;
        $attribute = !empty($_REQUEST) ? $_REQUEST : null;
        $event = $attribute ? array_key_first($attribute) : null;

        if (!$attribute || !in_array($event, $attributes)) {
            return 404;
        }

        if (empty($_REQUEST[$event])) {
            return 400;
        }

        global $wpdb;
        $table = $wpdb->prefix . DATABASE;
        $gclid = sanitize_text_field($_REQUEST[$event]);

        $save = $wpdb->prepare("INSERT INTO {$table} (gclid, event) VALUES (%s, %s)", $gclid, $event);
        $wpdb->query($save);
    }
}