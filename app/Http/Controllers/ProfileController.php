<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Profile;
use App\Queries\ProfilePageQuery;
use App\Queries\ProfileWithRepliesQuery;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Profile $profile): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $profile->loadCount(['following', 'followers']);

        $posts = ProfilePageQuery::for($profile, Auth::user()?->profile)->get();

        // For demonstration purposes, we'll return a simple view with the handle.
        // In a real application, you would fetch the profile data from the database.
        return view('profiles.show', ['profile' => $profile, 'posts' => $posts]);
    }

    public function replies(Profile $profile): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $profile->loadCount(['following', 'followers']);

        $posts = ProfileWithRepliesQuery::for($profile, Auth::user()?->profile)->get();

        return view('profiles.replies', ['profile' => $profile, 'posts' => $posts]);
    }

    public function follow(Profile $profile)
    {
        $currentProfile = Auth::user()->profile;

        $follow = Follow::createFollow($currentProfile, $profile);

        return response()->json(['follow' => $follow]);
    }

    public function unfollow(Profile $profile)
    {
        $currentProfile = Auth::user()->profile;

        $success = Follow::removeFollow($currentProfile, $profile);

        return response()->json(['success' => $success]);
    }
}
