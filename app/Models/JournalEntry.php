<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'content',
        'skill_id',
        'goal_id',
        'date'
    ];

    public function skill()
    {
        return $this->belongsTo(JournalEntry::class, 'skill_id');
    }

    public function goal()
    {
        return $this->belongsTo(JournalEntry::class, 'goal_id');
    }
}
