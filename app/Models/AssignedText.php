<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedText extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'created_by',
        'status',
        'deadline',
        'notes',
        'priority',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'assigned_text_users', 'assigned_text_id', 'user_id')
                    ->withTimestamps();
    }
}
