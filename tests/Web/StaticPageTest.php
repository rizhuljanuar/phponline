<?php

use JustSteveKing\StatusCode\Http;

use function Pest\Laravel\get;

it('test the status code for static pages', function ($page) {
    get($page)->assertStatus(Http::OK);
})->with(['/']);
