<?php

namespace App\GoogleOffline;

date_default_timezone_set('America/Sao_Paulo');

class Leads
{
    public function getAll()
    {
        global $wpdb;
        $table = $wpdb->prefix . DATABASE;

        $leads = $wpdb->get_results("SELECT * FROM {$table}", OBJECT);

        return $leads;
    }

    public function newLead()
    {
        if (is_admin()) {
            return false;
        }

        global $attributes;
        $attribute = !empty($_REQUEST) ? $_REQUEST : [];
        $event = $attribute ? array_key_first($attribute) : null;

        if (!$attribute || !in_array($event, $attributes)) {
            return 404;
        }

        if (empty($_REQUEST[$event])) {
            return 400;
        }

        global $wpdb;
        $table  = $wpdb->prefix . DATABASE;
        $gclid  = sanitize_text_field($_REQUEST[$event]);
        $time   = date('Y-m-d H:i:s', strtotime('now'));
        $ip   = $_SERVER['REMOTE_ADDR'] == '127.0.0.1' ? '8.8.8.8' : $_SERVER['REMOTE_ADDR'];
        $ipInfo = IpApi::getData($ip);
        $cidade = mb_strtoupper($ipInfo->city);
        $uf     = $ipInfo->region;
        $ddd    = Cities::getData($cidade)->DDD ?? null;

        $save = $wpdb->prepare("INSERT INTO {$table}
        (gclid, event, time, ip, code_area, city, state)
        VALUES (%s, %s, %s, %s, %s, %s, %s)", $gclid, $event, $time, $ip, $ddd, $cidade, $uf);
        $wpdb->query($save);
    }
}