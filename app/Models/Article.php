<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory, HasUuids, InteractsWithMedia;

    protected $fillable = [
        'title',
        'abstract',
        'authors_name',
        'no_page',
        'authors_email',
        'keywords',
        'journal_id',
        'other_authors_name',
        'other_authors_email',
        'attachment',
        'accepted',
        'status',
        'received',
    ];

    protected $casts = [
        'other_authors_name' => 'array',
        'other_authors_email' => 'array',
        'attachment' => 'string',
        'accepted' => 'date',
        'status' => 'boolean',
        'received' => 'date',
    ];

    /** @codeCoverageIgnore */
    protected function attaach(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia('attachment') ?: null
        );
    }

    public function journal(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
    }
}
