<?php

use App\Enums\HttpStatusCode;
use App\Models\Editor;

it('has editors/delete', function () {
    $user = actingAs();
    $editor= Editor::factory()->create();

    $response = $this->delete(route('editors.destroy', ['editor' => $editor->id]))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);

    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('editor deleted successfully');
});