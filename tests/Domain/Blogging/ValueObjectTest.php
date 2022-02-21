<?php

use Domain\Blogging\Factories\PostFactory;
use Domain\Blogging\ValueObjects\PostValueObject;

it('can create a new post value object using the factory', function () {
    $data = [
        'title' => 'Test',
        'body' => 'Test',
        'description' => 'Test',
        'published' => true,
    ];

    $post = PostFactory::create(
        attributes: $data
    );

    expect($post)->toBeInstanceOf(PostValueObject::class);

    expect($post->toArray())->toEqual($data);
});
