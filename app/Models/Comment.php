<?php

namespace App\Models;

use App\Models\Filters\CommentFilter;
use App\Models\Filters\QueryFilter;
use App\Models\Traits\EntityFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory, EntityFilter;

    protected $fillable = [
        'content', 'user_id', 'post_id',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
