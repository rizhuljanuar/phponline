<?php

declare(strict_types=1);

namespace Domain\Blogging\Models;

use Database\Factories\PostFactory;
use Domain\Blogging\Models\Builders\PostBuilder;
use Domain\Blogging\Models\Collections\PostCollection;
use Domain\Blogging\Models\Concerns\IsPost;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use IsPost;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'key',
        'title',
        'slug',
        'body',
        'description',
        'published',
        'user_id',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class, 
            foreignKey: 'user_id',
        );
    }

    protected static function newFactory(): PostFactory
    {
        return resolve(PostFactory::class);
    }

    public function newCollection(array $models = []): PostCollection
    {
        return new PostCollection(
            items: $models,
        );
    }

    public function newEloquentBuilder($query): PostBuilder
    {
        return new PostBuilder(
            query: $query,
        );
    }
}
