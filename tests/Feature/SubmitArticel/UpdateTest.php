<?php

use App\Enums\HttpStatusCode;
use App\Models\SubmitArticle;

it('has submit article/update page', function () {
    $user = actingAs();
    $submit = SubmitArticle::factory()->create();

    $data = [
       'status' => 'approved'
    ];

    $response = $this->put(route('submit-article.update', ['submit_article' => $submit]), $data)
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);

    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Article updated successfully');
});