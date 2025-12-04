<?php

use App\Models\Follow;
use App\Models\Profile;
use App\Models\User;

test('authenticated users can view their timeline', function () {
    $profile = Profile::factory()->create();

    $otherProfile = Profile::factory()->create();

    $this->actingAs($profile->user);

    $profile->follow($otherProfile);

    expect($profile->following)->toHaveCount(1);

    visit(route('posts.index'))->debug();
});
