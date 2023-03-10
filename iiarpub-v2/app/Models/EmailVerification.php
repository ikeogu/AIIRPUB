<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    protected $table = 'email_verifications';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'email';

    protected $fillable = ['email', 'otp', 'expired_at'];

    public function scopeExpired(Builder $query): Builder 
    {
        return $query->where('expired_at', '<', now());
    }

}