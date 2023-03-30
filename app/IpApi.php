<?php

namespace App\GoogleOffline;

class IpApi
{
    public static function getData($ip)
    {
        $request = wp_remote_get("http://ip-api.com/json/{$ip}?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query");
        $response = wp_remote_retrieve_body($request);

        if (is_wp_error($response)) {
            return false;
        }

        $response = json_decode($response);

        if ($response->status == 'fail') {
            return false;
        }

        return $response;
    }
}