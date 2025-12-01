<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feed', function () {
    $feedItems = json_decode(json_encode([
        [
            'postedDateTime' => '3h',
            'profile' => [
                'avatar' => '/images/alessia.png',
                'alt' => 'Avatar of Alessia',
                'displayName' => 'Alessia',
                'handle' => 'alessia_draws',
            ],
            'likeCount' => 23,
            'replyCount' => 45,
            'repostCount' => 151,
            'saveCount' => 12,
            'content' => <<<str
                <p>
                    I made this! <a href="#">#myart</a> <a href="#">#mypixl</a>
                </p>
                <img src="/images/simon-chilling.png" alt=" " />
            str,
            'replies' => [
                [
                    'postedDateTime' => '3h',
                    'profile' => [
                        'avatar' => '/images/simon-chilling.png',
                        'alt' => 'Avatar of Simon',
                        'displayName' => 'Simon',
                        'handle' => '@simonswiss',
                    ],
                    'likeCount' => 52,
                    'replyCount' => 12,
                    'repostCount' => 200,
                    'content' => <<<str
                        <p>lmao I'm buying this I don't even care.</p>
                    str,

                ]
            ]
        ]
    ]));

    return view('feed', compact('feedItems'));
});

Route::get('/profile', function () {
    return view('profile');
});
