<?php

use App\Enums\HttpStatusCode;
use App\Models\Category;
use App\Models\SubmitArticle;

use function Pest\Laravel\assertDatabaseCount;

it('has submitted articles /fetch all', function () {
    $user = actingAs();
    SubmitArticle::factory(10)->create();

    $response = $this->get(route('submit-article.index'))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);
    assertDatabaseCount('submit_articles', 10);
    expect($response['message'])->toBe('Listed successfully');
});

it('has submitted articles/fetch one', function () {
    $user = actingAs();
    $submitArticle =SubmitArticle::factory()->create();

    $response = $this->get(route('submit-article.show', ['submit_article' => $submitArticle->id]))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);
    assertDatabaseCount('submit_articles', 1);
    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Article retrieved successfully');
});