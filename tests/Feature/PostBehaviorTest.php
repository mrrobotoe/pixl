<?php

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('allows a profile to publish a post', function () {
    $profile = Profile::factory()->create();

    $post = Post::publish($profile, 'This is a test post.');

    expect($post)->toBeInstanceOf(Post::class)
        ->and($post->content)->toBe('This is a test post.')
        ->and($post->profile_id)->toBe($profile->id)
        ->and($post->parent_id)->toBeNull()
        ->and($post->repost_parent_id)->toBeNull();
});

test('can reply to post', function () {
    $original_post = Post::factory()->create();

    $replier = Profile::factory()->create();

    $reply = Post::reply($replier, $original_post, 'This is a reply.');

    expect($reply->parent->is($original_post))->toBeTrue()
        ->and($original_post->replies)->toHaveCount(1);
});

test('can have many replies to post', function () {
    $original_post = Post::factory()->create();

    $replies = Post::factory()->count(4)->reply($original_post)->create();

    expect($replies->first()->parent->is($original_post))->toBeTrue()
        ->and($original_post->replies)->toHaveCount(4)
        ->and($original_post->replies->contains($replies->first()))->toBeTrue();
});

test('create plain repost', function () {
    $original_post = Post::factory()->create();

    $repost_profile = Profile::factory()->create();

    $repost = Post::repost($repost_profile, $original_post);

    expect($repost->repostOf->is($original_post))->toBeTrue()
        ->and($original_post->reposts)->toHaveCount(1)
        ->and($repost->content)->toBeNull();
});

test('can have many reposts of post', function () {
    $original_post = Post::factory()->create();
    $reposts = Post::factory()->count(4)->repost($original_post)->create();

    expect($reposts->first()->repostOf->is($original_post))->toBeTrue()
        ->and($original_post->reposts)->toHaveCount(4)
        ->and($original_post->reposts->contains($reposts->first()))->toBeTrue();
});

test('quote repost', function () {
    $content = 'This is a quote repost.';
    $original_post = Post::factory()->create();

    $repost_profile = Profile::factory()->create();

    $quote_repost = Post::repost($repost_profile, $original_post, $content);

    expect($quote_repost->repostOf->is($original_post))->toBeTrue()
        ->and($original_post->reposts)->toHaveCount(1)
        ->and($quote_repost->content)->toBe($content);
});

test('prevent duplicate reposts', function () {
    $original_post = Post::factory()->create();

    $repost_profile = Profile::factory()->create();

    $first_repost = Post::repost($repost_profile, $original_post);

    // Attempt to create a duplicate repost
    $second_repost = Post::repost($repost_profile, $original_post);

    expect($first_repost->id)->toBe($second_repost->id)
        ->and($original_post->reposts)->toHaveCount(1);
});

test('remove a repost', function () {
    $original_post = Post::factory()->create();

    $repost_profile = Post::factory()->repost($original_post)->create()->profile;

    $success = Post::removeRepost($repost_profile, $original_post);

    expect($success)->toBeTrue()
        ->and($original_post->reposts)->toHaveCount(0);
});
