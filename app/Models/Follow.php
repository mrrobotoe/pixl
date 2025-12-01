<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follow extends Model
{
    /** @use HasFactory<\Database\Factories\FollowFactory> */
    use HasFactory;

    protected $fillable = [
        'follower_profile_id',
        'followed_profile_id',
    ];

    public function follower(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'follower_profile_id');
    }

    public function followed(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'followed_profile_id');
    }

    public static function createFollow(Profile $follower, Profile $followed): ?self
    {
        if ($follower->id === $followed->id) {
            // Prevent a profile from following itself
            throw new \InvalidArgumentException('A profile cannot follow itself.');
        }

        return self::firstOrCreate([
            'follower_profile_id' => $follower->id,
            'followed_profile_id' => $followed->id,
        ]);
    }

    public static function removeFollow(Profile $follower, Profile $followed): bool
    {
        if ($follower->id === $followed->id) {
            // Prevent a profile from following itself
            throw new \InvalidArgumentException('A profile cannot unfollow itself.');
        }

        return self::where('follower_profile_id', $follower->id)
            ->where('followed_profile_id', $followed->id)
            ->delete() > 0;
    }
}
