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
        'active' => false,
        'url' => '',
        'deadline' => '',
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
