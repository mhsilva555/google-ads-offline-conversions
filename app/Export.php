<?php

namespace App\GoogleOffline;

use Shuchkin\SimpleXLSXGen;

class Export
{
    public static function xlsx($data, $file)
    {
        $xlsx = SimpleXLSXGen::fromArray( $data );
        $xlsx->saveAs(GOOGLE_OFF_PLUGIN_PATH . DIRECTORY_SEPARATOR . $file);
    }
}