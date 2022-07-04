<?php

return [
    'offline'        => env('ASSETS_OFFLINE', true),
    'enable_version' => env('ASSETS_ENABLE_VERSION', false),
    'version'        => env('ASSETS_VERSION', time()),
    'scripts'        => [
        'modernizr',
        'app','swiper','site','jquery'
    ],
    'styles'         => [
        'bootstrap','app','swiper'
    ],
    'resources'      => [
        'scripts' => [
            'app'       => [
                'use_cdn'  => false,
                'location' => 'footer',
                'src'      => [
                    'local' => '/js/app.js',
                ],
            ],
            'jquery' => [
                'use_cdn'  => true,
                'location' => 'header',
                'src'      => [
                    'local' => 'https://code.jquery.com/jquery-3.6.0.js',
                    'cdn'   => 'https://code.jquery.com/jquery-3.6.0.js',
                ],
                'attributes' => [
                    'integrity'   => 'sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=',
                    'crossorigin' => 'anonymous',
                ],
            ],
            'modernizr' => [
                'use_cdn'  => true,
                'location' => 'header',
                'src'      => [
                    'local' => '/vendor/core/packages/modernizr/modernizr.min.js',
                    'cdn'   => '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js',
                ],
            ],
            'swiper' => [
                'use_cdn'  => true,
                'location' => 'header',
                'src'      => [
                    'local' => 'https://unpkg.com/swiper/swiper-bundle.min.js',
                    'cdn'   => 'https://unpkg.com/swiper/swiper-bundle.min.js',
                ],
            ],
            'site' => [
                'use_cdn'  => true,
                'location' => 'footer',
                'src'      => [
                    'local' => '/js/site.js',
                    'cdn'   => 'https://unpkg.com/swiper/swiper-bundle.min.js',
                ],
            ],
        ],
        'styles'  => [
            'bootstrap' => [
                'use_cdn'    => true,
                'location'   => 'header',
                'src'        => [
                    'local' => '/packages/bootstrap/css/bootstrap.min.css',
                    'cdn'   => '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css',
                ],
                'attributes' => [
                    'integrity'   => 'sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB',
                    'crossorigin' => 'anonymous',
                ],
            ],
            'app' => [
                'use_cdn'    => false,
                'location'   => 'header',
                'src'        => [
                    'local' => '/css/app.css',
                    'cdn'   => '',
                ],
                'attributes' => [
//                    'integrity'   => 'sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB',
//                    'crossorigin' => 'anonymous',
                ],
            ],
            'swiper' => [
                'use_cdn'    => true,
                'location'   => 'header',
                'src'        => [
                    'local' => 'https://unpkg.com/swiper/swiper-bundle.min.css',
                    'cdn'   => 'https://unpkg.com/swiper/swiper-bundle.min.css',
                ],
                'attributes' => [
//                    'integrity'   => 'sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB',
//                    'crossorigin' => 'anonymous',
                ],
            ],
        ],
    ],
];
