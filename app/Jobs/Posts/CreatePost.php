<?php

declare(strict_types=1);

namespace App\Jobs\Posts;

use Domain\Blogging\Actions\CreatePost as ActionsCreatePost;
use Domain\Blogging\ValueObjects\PostValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreatePost implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use SerializesModels;
    use InteractsWithQueue; 

    public function __construct(
        public PostValueObject $object
    ){}

    public function handle(): void
    {
        ActionsCreatePost::handle(
            object: $this->object,
        );
    }
}
