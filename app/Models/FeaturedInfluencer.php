<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedInfluencer extends Model
{

    protected $fillable = [
        'influencer_id',
        'status',
        'influencer_category_id',
    ];

    protected $casts = [
        'status' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'influencer_id');
    }

    public function influencerCategory()
    {
        return $this->belongsTo(InfluencerCategory::class, 'influencer_category_id');
    }
}
