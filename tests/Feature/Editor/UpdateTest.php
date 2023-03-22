<?php

use App\Enums\HttpStatusCode;
use App\Models\Category;
use App\Models\Editor;

it('has editor/update page', function () {
    $user = actingAs();
    $editor= Editor::factory()->create();

    $data = [
        'name' => fake()->name(),
        'email' => fake()->email()
    ];

    $response = $this->put(route('editors.update', ['editor' => $editor->id]), $data)
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);

    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('editor updated successfully');
});