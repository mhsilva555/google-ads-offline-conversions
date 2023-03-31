<?php

namespace App\GoogleOffline\Ajax;

class DeleteExport
{
    public function __construct()
    {
        add_action('wp_ajax_delete_export', [$this, 'delete_export']);
    }

    public function delete_export()
    {
        $export_file = $_REQUEST['export_file'];

        if (file_exists(GOOGLE_OFF_PLUGIN_PATH . '/storage/export/'. $export_file)) {
            unlink(GOOGLE_OFF_PLUGIN_PATH . '/storage/export/'. $export_file);
        }
    }
}