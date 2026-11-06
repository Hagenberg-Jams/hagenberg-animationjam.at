<?php

/*
|--------------------------------------------------------------------------
| Hagenberg Animation Jam
|--------------------------------------------------------------------------
|
| Everything not set here comes from the engine's defaults and the
| animation preset. Access it using: config('jam.key').
|
*/

return [
    'type' => 'animation',

    'website' => env('JAM_WEBSITE', 'https://hagenberg-animationjam.at'),
    'email' => env('JAM_EMAIL', 'info@hagenberg-gamejam.at'),

    'company' => [
        'name' => 'University of Applied Sciences Upper Austria – Department of Digital Media',
        'url' => 'https://fh-ooe.at/',
        'address' => 'Softwarepark 11, 4232 Hagenberg, Austria',
    ],

    'social' => [
        'youtube' => 'https://www.youtube.com/@AnimationJamHagenberg',
        'discord' => 'https://discord.gg/bwDKWyx5g2',
    ],

    'latest_jam' => env('JAM_LATEST_JAM', '2026'),

    'registration' => [
        'active' => true,
        'url' => '',
        // Provisional until the team confirms the deadline.
        'deadline' => '2026-11-18 23:59',
        'form' => [
            'enabled' => true,
            'team_size' => [1, 6],
            'onsite_capacity' => null,
            'fields' => [
                'participation' => false,
                'discord' => true,
                'programs' => false,
                'comment' => true,
            ],
            'nickname_label' => 'Nickname or artist name',
            // Organisers are in the GitHub secret JAM_REGISTRATION_NOTIFY.
            'from' => 'noreply@hagenberg-animationjam.at',
            'retention_days' => 90,
            'turnstile_site_key' => '0x4AAAAAAF1l4nKLfg338ULF',
            'access' => [
                'team' => 'hagenberg-jams',
                'aud' => '2463644e00132d480080a88533ff36ca72e5f92c020f08230c1b4752ad027713',
            ],
        ],
    ],

    'features' => [
        // Turn this on once _data/projects/ contains projects with team members.
        'people' => false,
    ],

    'awards' => [
        'animation' => 'Best Animation',
        'sound' => 'Best Sound',
        'composition' => 'Best Composition',
        'storytelling' => 'Best Storytelling',
        'shitpost' => 'Best Shitpost',
        'experimental' => 'Best Experimental Animation',
    ],
];
