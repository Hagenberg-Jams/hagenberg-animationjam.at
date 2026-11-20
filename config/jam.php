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
        'youtube' => 'https://www.youtube.com/@hagenberganimationjam',
        'discord' => 'https://discord.gg/KWnxDk5dXP',
    ],

    'latest_jam' => env('JAM_LATEST_JAM', '2026'),

    'registration' => [
        'active' => true,
        'url' => 'https://forms.gle/maLQY5B7UceQki8z7',
        'deadline' => '2026-11-16 23:59',
    ],

    // Upload page at /submit for the end of the jam. Teams come from _data/teams/YYYY.yaml,
    // the upload code from the GitHub secret JAM_SUBMISSION_CODE. See the README of the engine.
    'submission' => [
        'enabled' => true,
        // Empty: the end of the jam. Later uploads are marked as late.
        'deadline' => '',
        'turnstile_site_key' => '0x4AAAAAAF1l4nKLfg338ULF',
        'from' => 'noreply@hagenberg-animationjam.at',
        // The Cloudflare Access application "Animation Jam Admin" protects /admin/submissions.
        'access' => [
            'team' => 'hagenberg-jams',
            'aud' => '2463644e00132d480080a88533ff36ca72e5f92c020f08230c1b4752ad027713',
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
