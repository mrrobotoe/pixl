<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dev/login', function() {
    $user = User::find(20);

    Auth::login($user);

    request()->session()->regenerate();

    return redirect()->intended(route('profiles.show', $user->profile));
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::scopeBindings()->group(function () {
        Route::post('/{profile:handle}/status/{post}/reply',
            [PostController::class, 'reply'])->name('posts.reply');
    });

});

Route::get('/dev/logout', function() {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerate();

    return redirect()->intended('/feed');
})->name('logout');

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
    return view('profile', compact('feedItems'));
});

Route::get('/{profile:handle}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/{profile:handle}/replies', [ProfileController::class, 'replies'])->name('profiles.replies');

Route::scopeBindings()->group(function () {
    Route::get('/{profile:handle}/status/{post}', [PostController::class, 'show'])->name('posts.show');
});
