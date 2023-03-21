<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Journal extends Model
{
    use HasFactory, HasUuids;


    protected $fillable = [
        'name',
        'volume',
        'issue',
        'year',
        'month',
        'issn',
        'category_id'
    ];


    public function articles() : HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}