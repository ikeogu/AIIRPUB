<?php

use App\Enums\HttpStatusCode;
use App\Models\Journal;

use function Pest\Laravel\assertDatabaseCount;

it('has journal/fetch all', function () {
    $user = actingAs();
    Journal::factory(10)->create();

    $response = $this->get(route('journals.index'))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);
    assertDatabaseCount('journals', 10);
    expect($response['message'])->toBe('Journals retrieved successfully');
});

it('has editor/fetch one', function () {
    $user = actingAs();
    $journal = Journal::factory()->create();

    $response = $this->get(route('journals.show', ['journal' => $journal->id]))
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);
    assertDatabaseCount('journals', 11);
    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Journal retrieved successfully');
});
