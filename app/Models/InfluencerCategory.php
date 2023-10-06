<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfluencerCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}