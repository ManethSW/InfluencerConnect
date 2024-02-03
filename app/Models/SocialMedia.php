<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = [
        'user_id',
        'personal_website',
        'linkedin',
        'facebook',
        'instagram',
        'twitter',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
