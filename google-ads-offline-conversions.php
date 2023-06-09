<?php

/*
 * Plugin Name: Google Ads Offline Conversions
 * Author: Marcos Henrique
 * Author URI: https://github.com/mhsilva555
 * Description: Plugin para Gerenciar Conversões Offline do Google Ads
 * Version: 1.0.0
 * License: MIT License
 * License URI: https://mit-license.org/
 * Text Domain: google-ads-offline-conversions
 * Domain Path: /languages
 */

if (!function_exists('add_action') || !defined('ABSPATH')) {
    wp_die();
}

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/attributes.php';
require_once __DIR__ . '/config/defines.php';
require_once __DIR__ . '/bootstrap/app.php';