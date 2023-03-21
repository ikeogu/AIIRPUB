<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SubmitArticle extends Model implements HasMedia
{
    use HasFactory, HasUuids, InteractsWithMedia;

    protected $fillable =[
        'authors_name',
        'authors_email',
        'title_of_article',
        'country',
        'article',
        'status'
    ];

    protected $guarded = ['id'];

    /** @codeCoverageIgnore */
    protected function article(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMedia('article') ?: null
        );
    }
}