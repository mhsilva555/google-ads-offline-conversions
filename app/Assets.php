<?php

namespace App\GoogleOffline;

class Assets
{
    private $permissions = [
        "toplevel_page_leads",
        "enquetes_page_leads",
    ];

    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'styles']);
        add_action('admin_enqueue_scripts', [$this, 'scripts']);
    }

    public function styles($hook)
    {
        if (in_array($hook, $this->permissions)):
            wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css', [], '5.9.0');
            wp_enqueue_style('bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css', [], '5.2.3');
            wp_enqueue_style('styles', GOOGLE_OFF_PLUGIN_URI . '/resources/css/estilos.css', [], false);
        endif;
    }

    public function scripts($hook)
    {
        if (in_array($hook, $this->permissions)):
            wp_enqueue_media();
            wp_enqueue_script('app', GOOGLE_OFF_PLUGIN_URI . '/resources/js/app.js', ['jquery'], false, true);

            wp_localize_script('app', 'obj', [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'adminurl' => admin_url(),
                'ajax_nonce' => wp_create_nonce(-1),
                'edit_survey' => isset($_GET['page']) && $_GET['page'] == 'leads',
            ]);
        endif;
    }
}