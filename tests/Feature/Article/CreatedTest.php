<?php

use App\Models\Journal;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;


it('can publish article', function () {
    $user = actingAs();
    $journal = Journal::factory()->create();

    Storage::fake('articles');

    $file = UploadedFile::fake()->create('article.pdf', 1000, 'application/pdf');


    $data = [
        'title' => fake()->title(),
        'abstract' => fake()->text(),
        'authors_name' => fake()->name(),
        'no_page' => '3 - 10',
        'authors_email' => fake()->email(),
        'keywords' => fake()->word(),
        'journal_id' => $journal->id,
        'other_authors_name' => [fake()->name(), fake()->name()],
        'other_authors_email' => [fake()->email(), fake()->email()],
        'attachment' => $file,
        'accepted' => fake()->date(),
        'status' => true,
        'received' => fake()->date(),
    ];

    $response = $this->post(route('articles.store'), $data);

    $response->assertStatus(201);

    assertDatabaseCount('articles', 1);
   // assertDatabaseHas('articles', Arr::except($data, ['attachment', 'other_authors_name', 'other_authors_email']));
    expect($response['success'])->toBeTruthy();
    expect($response['message'])->toBe('Article Published successfully');
});
