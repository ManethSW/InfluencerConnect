<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    protected $fillable = [
        'user_id',
        'document_type',
        'document_reference',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
