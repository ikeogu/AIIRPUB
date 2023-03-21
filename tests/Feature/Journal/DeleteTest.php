<?php

use App\Enums\HttpStatusCode;
use App\Models\Journal;

it('has journal/delete', function () {
    $user = actingAs();
    $journal = Journal::factory()->create();

    $response = $this->delete(route('journals.destroy', ['journal' => $journal->id]))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);

    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Journal deleted successfully');
});