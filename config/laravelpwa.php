<?php

return [
    'name' => env('APP_NAME', 'Armario Móvil'),
    'manifest' => [
        'name' => env('APP_NAME', 'Armario Móvil'),
        'short_name' => env('APP_NAME', 'Comercio electrónico'),
        'start_url' => env('APP_URL', '/'),
        'background_color' => '#181b48',
        'theme_color' => '#181b48',
        'display' => 'standalone',
        'orientation' => 'any',
        'icons' => [
            '72x72' => '/images/responsive/icons/72x72.png',
            '96x96' => '/images/responsive/icons/96x96.png',
            '128x128' => '/images/responsive/icons/128x128.png',
            '144x144' => '/images/responsive/icons/144x144.png',
            '152x152' => '/images/responsive/icons/152x152.png',
            '192x192' => '/images/responsive/icons/192x192.png',
            '384x384' => '/images/responsive/icons/384x384.png',
            '512x512' => '/images/responsive/icons/512x512.png'
        ],
        'splash' => [
            '640x1136' => '/images/responsive/splash/640x1136.png',
            '750x1334' => '/images/responsive/splash/750x1334.png',
            '828x1792' => '/images/responsive/splash/828x1792.png',
            '1125x2436' => '/images/responsive/splash/1125x2436.png',
            '1242x2208' => '/images/responsive/splash/1242x2208.png',
            '1242x2688' => '/images/responsive/splash/1242x2688.png',
            '1536x2048' => '/images/responsive/splash/1536x2048.png',
            '1668x2224' => '/images/responsive/splash/1668x2224.png',
            '1668x2388' => '/images/responsive/splash/1668x2388.png',
            '2048x2732' => '/images/responsive/splash/2048x2732.png',
        ],
        'custom' => [
            "gcm_sender_id" => "103953800507"
        ]
    ]
];