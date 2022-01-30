<?php

declare(strict_types=1);

namespace Domain\Blogging\Projectors;

use Domain\Blogging\Actions\CreatePost;
use Domain\Blogging\Actions\UpdatePost;
use Domain\Blogging\Events\PostWasCreated;
use Domain\Blogging\Events\PostWasUpdated;
use Domain\Blogging\Models\Post;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class PostProjector extends Projector
{
    public function onPostWasCreated(PostWasCreated $event): void
    {
        CreatePost::handle(
            object: $event->object,
            uuid: $event->aggregateRootUuid(),
        );
    }

    public function onPostWasUpdated(PostWasUpdated $event): void
    {
        UpdatePost::handle(
            object: $event->object,
            post: Post::find($event->postID),
        );
    }
}