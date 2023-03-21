<?php

use App\Models\Category;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;


it('can submit journal', function () {
    $user = actingAs();
    $category = Category::factory()->create();
    $data = [
        'name' => fake()->name(),
        'volume' => "3",
        'issue' => 'rwrw44-42',
        'year' => '2021',
        'month' => 'Feb',
        'issn' => '4wee',
        'category_id' => $category->id
    ];

    $response = $this->post(route('journals.store'), $data);

    $response->assertStatus(201);

    assertDatabaseCount('journals', 1);
    assertDatabaseHas('journals', $data);
    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Journal created successfully');
});