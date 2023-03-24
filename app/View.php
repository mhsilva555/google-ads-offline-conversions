<?php

namespace App\GoogleOffline;

use Fiskhandlarn\Blade;

class View
{
    public static function render($template, $data = [])
    {
        $blade = new Blade(GOOGLE_OFF_PLUGIN_PATH . '/resources/views', GOOGLE_OFF_PLUGIN_PATH . '/storage/cache');
        echo $blade->render($template, $data);
    }
}