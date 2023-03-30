<?php

namespace App\GoogleOffline;

class CepApi
{
    public static function getData($cep)
    {
        $request = wp_remote_get("https://viacep.com.br/ws/{$cep}/json/");
        $response = wp_remote_retrieve_body($request);

        if (is_wp_error($response)) {
            return false;
        }

        $response = json_decode($response);

        if (!$response) {
            return false;
        }

        return $response;
    }
}