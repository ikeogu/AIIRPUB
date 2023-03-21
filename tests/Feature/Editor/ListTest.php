<?php

use App\Enums\HttpStatusCode;
use App\Models\Category;
use App\Models\Editor;

use function Pest\Laravel\assertDatabaseCount;

it('has editor/fetch all', function () {
    $user = actingAs();
    Editor::factory(10)->create();

    $response = $this->get(route('editors.index'))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);
    assertDatabaseCount('editors', 10);
    expect($response['message'])->toBe('editors fetched successfully');
});

it('has editor/fetch one', function () {
    $user = actingAs();
    $editor = Editor::factory()->create();

    $response = $this->get(route('editors.show', ['editor' => $editor->id]))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);
    assertDatabaseCount('editors', 11);
    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('editor fetched successfully');
});