<?php

return [
    'default' => env('BROADCAST_DRIVER', 'pusher'),

    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('3fc0d65259a728d1e12e'),
            'secret' => env('b183d222a7b2ef035085'),
            'app_id' => env('1938374'),
            'options' => [
            'cluster' => 'ap1',
            'useTLS' => true
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],
    ],
];
