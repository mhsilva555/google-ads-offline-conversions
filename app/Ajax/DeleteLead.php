<?php

namespace App\GoogleOffline\Ajax;

use App\GoogleOffline\Leads;

class DeleteLead
{
    public function __construct()
    {
        add_action('wp_ajax_delete_lead', [$this, 'delete_lead']);
    }

    public function delete_lead()
    {
        $id = $_REQUEST['lead_id'];

        $leads = new Leads();
        $delete = $leads->delete($id);

        if (!$delete) {
            wp_send_json(400);
        }

        wp_send_json(200);
    }
}