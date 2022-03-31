<?php

namespace App\Models;

use App\Models\Traits\EntityFilter;
use DOMDocument;
use DOMXPath;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory, EntityFilter;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'posted_at',
    ];

    protected $dates = ['posted_at'];


    public function getRouteKeyName(): string
    {
        return 'slug';

    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);

    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);

    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }


    public function scopeLatestDesc(Builder $query): Builder
    {
        return $query->orderBy('updated_at', 'desc');

    }


    public function scopePosted(Builder $query): Builder
    {
        return $query->where('posted_at', '<>', null);

    }


    public function getFirstParagraph()
    {
        return Cache::remember(
            "post_announce_$this->slug",
            3600,
            function () {
                $dom = new DOMDocument();
                $dom->loadHTML($this->content);
                $xp = new DOMXPath($dom);
                return $xp->query('//p')[0]->nodeValue;
            }
        );

    }


}
