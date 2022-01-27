<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Posts\StoreRequest;
use App\Jobs\Posts\CreatePost;
use Domain\Blogging\Factories\PostFactory;
use JustSteveKing\StatusCode\Http;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        // authorize

        // create the resource
        CreatePost::dispatch(
            PostFactory::create(
                attributes: $request->validated()
            ),
        );

        return response(
            content: null,
            status: Http::ACCEPTED
        );
    }
}
