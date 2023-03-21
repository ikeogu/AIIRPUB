<?php


use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('can submit article', function () {
    $user = actingAs();
    $data = [
        'authors_name' => 'John Doe',
        'authors_email' => fake()->email,
        'title_of_article' => fake()->sentence,
        'country' => fake()->country,
        //'article' => ,
        'status' => 'pending',

    ];

    $response = $this->post(route('submit-article.store'), $data);

    $response->assertStatus(201);

    assertDatabaseCount('submit_articles', 1);
    assertDatabaseHas('submit_articles', $data);
    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Article submitted successfully');
});
