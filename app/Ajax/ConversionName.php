<?php

namespace App\GoogleOffline\Ajax;

class ConversionName
{
    public function __construct()
    {
        add_action('wp_ajax_update_conversion_name', [$this, 'update_conversion_name']);
    }

    public function update_conversion_name()
    {
        $conversion_name = sanitize_text_field($_REQUEST['conversion_name'] ?? '');

        update_option('google_conversion_name', $conversion_name);
    }
}