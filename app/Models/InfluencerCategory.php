<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfluencerCategory extends Model
{
    public function influencerCards()
    {
        return $this->hasMany(InfluencerCard::class);
    }
    protected $fillable = [
        'name',
        'status',
    ];
}
