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
