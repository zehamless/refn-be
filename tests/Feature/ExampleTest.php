<?php

it('returns a successful response', function () {
    $response = $this->get(route('dashboard'));
    dump($response->content());
    $response->assertStatus(200);
    $response->assertJsonStructure([
        'unpaid',
        'processing',
        'completed',
        'cancelled',
    ]);
});
it('get recent order', function () {
    $response = \Pest\Laravel\get(route('dashboard.recent-orders'));
    dump($response->content());
});
it('get processing order', function () {
    $response = \Pest\Laravel\get(route('dashboard.processing-orders'));
//    dump($response->content());
    assert($response->status() === 200);
});
