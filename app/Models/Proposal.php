<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'collaboration_id',
        'influencer_id',
        'proposed_budget',
        'supporting_links',
        'supporting_files',
        'status',
    ];

    public function collaboration()
    {
        return $this->belongsTo(Collaboration::class);
    }

    public function influencer()
    {
        return $this->belongsTo(User::class, 'influencer_id');
    }
}
