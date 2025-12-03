<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\Profile;
use App\Queries\ProfilePageQuery;
use App\Queries\ProfileWithRepliesQuery;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        $profile->loadCount(['following', 'followers']);

        $posts = ProfilePageQuery::for($profile, Auth::user()?->profile)->get();


        // For demonstration purposes, we'll return a simple view with the handle.
        // In a real application, you would fetch the profile data from the database.
        return view('profiles.show', compact('profile', 'posts'));
    }

    public function replies(Profile $profile)
    {
        $profile->loadCount(['following', 'followers']);

        $posts = ProfileWithRepliesQuery::for($profile, Auth::user()?->profile)->get();

        return view('profiles.replies', compact('profile', 'posts'));
    }

    public function follow(Profile $profile)
    {
        $currentProfile = Auth::user()->profile;

        $follow = Follow::createFollow($currentProfile, $profile);

        return response()->json(compact('follow'));
    }

    public function unfollow(Profile $profile)
    {
        $currentProfile = Auth::user()->profile;

        $success = Follow::removeFollow($currentProfile, $profile);

        return response()->json(compact('success'));
    }
}
