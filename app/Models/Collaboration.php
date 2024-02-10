<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'title',
        'collaboration_type',
        'description',
        'budget',
        'deadline',
        'status',
    ];

    protected $casts = [
        'collaboration_type' => 'int',
        'status' => 'int',
        'budget' => 'float',
    ];

    public function business()
    {
        return $this->belongsTo(User::class, 'business_id');
    }

    public function influencer()
    {
        return $this->belongsTo(User::class, 'influencer_id');
    }

    public function tasks()
    {
        return $this->hasMany(CollaborationTask::class);
    }
}
