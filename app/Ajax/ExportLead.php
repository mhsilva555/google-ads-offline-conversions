<?php

namespace App\GoogleOffline\Ajax;

use App\GoogleOffline\Leads;

class ExportLead
{
    public function __construct()
    {
        add_action('wp_ajax_export_lead', [$this, 'export_lead']);
    }

    public function export_lead()
    {
        $id = $_REQUEST['lead_id'];

        $leads = new Leads();
        $export = $leads->export($id);

        if (!$export) {
            wp_send_json(400);
        }

        wp_send_json(200);
    }
}