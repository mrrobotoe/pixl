<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'content',
        'parent_id',
        'profile_id',
        'repost_parent_id',
    ];

    public function isRepost(): bool
    {
        return !is_null($this->repost_parent_id);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'parent_id');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public static function publish(Profile $profile, string $content): self
    {
        return static::create([
            'profile_id' => $profile->id,
            'content' => $content,
            'parent_id' => null,
            'repost_parent_id' => null,
        ]);
    }

    public static function removeRepost(Profile $profile, Post $original_post): bool
    {
        return static::where('profile_id', $profile->id)
            ->where('repost_parent_id', $original_post->id)
            ->delete() > 0;
    }

    public function replies(): HasMany
    {
        // all posts that have this post as their parent
        return $this->hasMany(Post::class, 'parent_id');
    }

    public static function reply(Profile $profile, Post $original_post, string $content): self
    {
        return static::create([
            'profile_id' => $profile->id,
            'content' => $content,
            'parent_id' => $original_post->id,
            'repost_parent_id' => null,
        ]);
    }

    public static function repost(Profile $profile, Post $original_post, string $content = null): self
    {
        return static::firstOrCreate([
            'profile_id' => $profile->id,
            'content' => $content,
            'parent_id' => null,
            'repost_parent_id' => $original_post->id,
        ]);
    }

    public function reposts(): HasMany
    {
        return $this->hasMany(Post::class, 'repost_parent_id');
    }

    public function repostOf(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'repost_parent_id');
    }
}
