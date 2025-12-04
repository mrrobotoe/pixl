<?php

use App\Models\Profile;

test('it follows another profile', function () {
    $profile = Profile::factory()->create();

    $otherProfile = Profile::factory()->create();

    $this->actingAs($profile->user);

    visit(route('profiles.show', $otherProfile))
        ->click('@follow-profile-button')
        ->assertSee('Unfollow');

    expect($profile->following)->toHaveCount(1);
});
