<?php

use App\Enums\HttpStatusCode;
use App\Models\Journal;

it('has journals/update page', function () {
    $user = actingAs();
    $journal = Journal::factory()->create();

    $data = [
        'year' => "2023",
    ];

    $response = $this->put(route('journals.update', ['journal' => $journal->id]), $data)
        ->assertStatus(HttpStatusCode::SUCCESSFUL->value);

    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Journal updated successfully');
});