<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'qualification',
        'employed_at',
        'email',
        'number_of_publications',
    ];
}