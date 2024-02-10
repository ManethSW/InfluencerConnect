<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaborationTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'collaboration_id',
        'description',
        'priority',
    ];

    protected $casts = [
        'priority' => 'int',
    ];

    public function collaboration()
    {
        return $this->belongsTo(Collaboration::class);
    }
}
