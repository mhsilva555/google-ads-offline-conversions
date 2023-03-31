<?php

namespace App\GoogleOffline;

use Shuchkin\SimpleXLSXGen;

date_default_timezone_set('America/Sao_Paulo');

class Leads
{
    public function getAll(): array|object|null
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

        if (get_option('google_conversion_name') == false) {
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
        $ip     = $_SERVER['REMOTE_ADDR'] == '127.0.0.1' ? '8.8.8.8' : $_SERVER['REMOTE_ADDR'];
        $ipInfo = IpApi::getData($ip);
        $cidade = mb_strtoupper($ipInfo->city);
        $uf     = $ipInfo->region;
        $ddd    = Cities::getData($cidade)->DDD ?? null;

        $save   = $wpdb->prepare("INSERT INTO {$table}
        (gclid, event, time, ip, code_area, city, state)
        VALUES (%s, %s, %s, %s, %s, %s, %s)", $gclid, $event, $time, $ip, $ddd, $cidade, $uf);
        $wpdb->query($save);
    }

    public function delete($id): bool
    {
        if (empty($id)) {
            return false;
        }

        $lead_id = sanitize_text_field($id);

        global $wpdb;
        $table = $wpdb->prefix . DATABASE;

        if (is_array($id)) {
            foreach ($id as $item) {
                $wpdb->delete($table, ['id' => $item]);
            }

            return true;
        }

        $wpdb->delete($table, ['id' => $lead_id]);

        return true;
    }

    public function export($id): bool
    {
        if (empty($id) || !is_array($id)) {
            return false;
        }

        global $wpdb;
        $table = $wpdb->prefix . DATABASE;
        $export = [];
        $conversion_name = get_option('google_conversion_name');

        $where_string = implode(', ', $id);
        $query = $wpdb->get_results("SELECT gclid,time FROM {$table} WHERE id in($where_string)", ARRAY_A);

        foreach ($query as $lead) {
            $export[] = [
                $lead['gclid'],
                $conversion_name,
                "\0".$lead['time']
            ];
        }

        $xlsx = SimpleXLSXGen::fromArray($export);
        $xlsx->saveAs(GOOGLE_OFF_PLUGIN_PATH . '/storage/export/'. 'export-' . date('d-m-Y-H-i-s') . '.xlsx');

        return true;
    }
}