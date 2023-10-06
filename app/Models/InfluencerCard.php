<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class InfluencerCard extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function influencerCategory()
    {
        return $this->belongsTo(InfluencerCategory::class);
    }
    protected $fillable = [
        'user_id',
        'avatar',
        'influencer_category_id',
        'rating',
        'description',
        'visible',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'visible' => 'boolean',
    ];
}
