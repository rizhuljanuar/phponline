<?php

use Domain\Blogging\Models\Post;
use Domain\Shared\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\StatusCode\Http;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

beforeEach(fn() => $this->post = Post::factory()->create());

it('tests the index route for posts', function() {
    get(route('api:v1:posts:index'))
    ->assertStatus(Http::OK)
    ->assertJson(function (AssertableJson $json) {
        $json->has(1)
            ->first(function (AssertableJson $json) {
                $json->where('id', $this->post->key)
                    ->where('attributes.title', $this->post->title)
                    ->etc();
            });
    });
});

it('tests the ability to create a new post', function () {
    User::factory()->create();

    post(route('api:v1:posts:store'), [
        'title' => 'new post',
        'description' => 'new description',
        'body' => 'new body'
    ])->assertNoContent(Http::ACCEPTED);
});

it('tests the ability to show an existing post', function () {
    get(route('api:v1:posts:show', $this->post->key))
        ->assertStatus(Http::OK)
        ->assertJson(function (AssertableJson $json) {
            $json->where('id', $this->post->key)
            ->missing('relationships.user')
            ->etc();
        });
});

it('tests the ability to show an existing post with the user information', function () {
    get("/api/v1/posts/{$this->post->key}?include=user")
        ->assertStatus(Http::OK)
        ->assertJson(function (AssertableJson $json) {
            $json->where('id', $this->post->key)
                ->has('relationships')
                ->where('relationships.user', null)
            ->etc();
        });
});

it('tests the ability to update a post', function () {
    User::factory()->create();
    
    $newTitle = 'test title';

    expect($this->post)->title->toBe($this->post->title);


    patch(
        route(
            'api:v1:posts:update', 
            $this->post->key
        ), array_merge(
            $this->post->toArray(), 
            ['title' => $newTitle],
        )
    )->assertNoContent(Http::ACCEPTED);

    $this->post->refresh();

    expect($this->post)->title->toBe($newTitle);
});

it('tests the ability to delete a post', function () {
    assertDatabaseHas('posts', [
        'id' => $this->post->id,
        'title' => $this->post->title
    ]);

    assertNull($this->post->deleted_at);

    delete(route('api:v1:posts:delete', $this->post->key))
        ->assertStatus(Http::ACCEPTED);

    $this->post->refresh();

    assertNotNull($this->post->deleted_at);
});
