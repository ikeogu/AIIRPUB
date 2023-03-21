<?php

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('can editor/ be created', function () {
    $user = actingAs();
    $data = [
        'name' => fake()->name(),
        'title' => fake()->title(),
        'qualification' => fake()->sentence(),
        'employed_at' => fake()->company(),
        'email' => fake()->email(),
        'number_of_publications' => 10,
    ];

    $response = $this->post(route('editors.store'), $data);

    $response->assertStatus(201);

    assertDatabaseCount('editors', 1);
    assertDatabaseHas('editors', $data);
    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('editor created successfully');
});