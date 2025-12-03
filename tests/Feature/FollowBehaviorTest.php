<?php

use App\Models\Follow;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('profile cannot follow itself', function () {
    $profile = Profile::factory()->create();

    expect(fn (): ?\App\Models\Follow => Follow::createFollow($profile, $profile))
        ->toThrow(\InvalidArgumentException::class, 'A profile cannot follow itself.');
});

test('profile can follow another profile', function () {
    $follower = Profile::factory()->create();
    $followed = Profile::factory()->create();

    $follow = Follow::createFollow($follower, $followed);

    expect($follow)->toBeInstanceOf(Follow::class)
        ->and($follow->follower_profile_id)->toBe($follower->id)
        ->and($follow->followed_profile_id)->toBe($followed->id);
});

test('can unfollow a profile', function () {
    $follower = Profile::factory()->create();
    $followed = Profile::factory()->create();

    $follow = Follow::createFollow($follower, $followed);
    $success = Follow::removeFollow($follower, $followed);

    expect($success)->toBeTrue()
        ->and(Follow::where('follower_profile_id', $follower->id)
            ->where('followed_profile_id', $followed->id)
            ->exists())->toBeFalse();
});
