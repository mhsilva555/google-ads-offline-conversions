<?php

namespace App\GoogleOffline;

class Dashboard
{
    public function create()
    {
        add_action('admin_menu', function () {
            add_menu_page(
                'Leads Google Conv. Offline',
                'Leads Google Conv. Offline',
                'administrator',
                'leads',
                [$this, 'callbackPageOption'],
                'dashicons-google',
                5
            );
        });
    }

    public function callbackPageOption()
    {
        $leads = new Leads();
        $all = $leads->getAll();
        View::render('dashboard', ['leads' => $all]);
    }
}