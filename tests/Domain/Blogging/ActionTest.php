<?php

use Domain\Blogging\Actions\CreatePost;
use Domain\Blogging\Actions\UpdatePost;
use Domain\Blogging\Models\Post;
use Domain\Blogging\ValueObjects\PostValueObject;
use Domain\Shared\Models\User;
use Illuminate\Support\Str;

it('can create a post from a value object and a uuid', function () {
    User::factory()->create();

    $data = [
        'title' => 'Test',
        'body' => 'Test',
        'description' => 'Test',
        'published' => true,
    ];

    $uuid = Str::uuid()->toString();

    $object = new PostValueObject(
        title: $data['title'],
        body: $data['body'],
        description: $data['description'],
        published: $data['published'],
    );

    expect(
        CreatePost::handle(
            object: $object,
            uuid: $uuid
        )
    )->toBeInstanceOf(Post::class);
});

it('can update a post from a value object and a post model', function () {
    $user = User::factory()->create();
    // dd($user->posts->create());
    $data = $user->create([
        'title' => 'Test',
        'body' => 'Test',
        'description' => 'Test',
        'published' => true,
    ]);

    $object = new PostValueObject(
        title: $data->title,
        body: $data->body,
        description: $data->description,
        published: $data->published,
    );

    expect(
        UpdatePost::handle(
            object: $object,
            post: $data
        ),
    )->toBeBool()->toBeTrue();
});
