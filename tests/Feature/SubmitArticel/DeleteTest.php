<?php

use App\Enums\HttpStatusCode;
use App\Models\Category;
use App\Models\SubmitArticle;

it('has category/delete', function () {
    $user = actingAs();
    $submitArticle = SubmitArticle::factory()->create();

    $response = $this->delete(route('submit-article.destroy', ['submit_article' => $submitArticle ]))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);

    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Article deleted successfully');
});