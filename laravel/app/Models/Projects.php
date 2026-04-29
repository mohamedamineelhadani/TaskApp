<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    
    protected $table = 'projects';

    protected $fillable = [
        'id_user',
        'name',
        'description',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'id_user');
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class , 'id_project');
    }

    public function completedTasks()
    {
        return $this->tasks()->where('status', 'completed');
    }

    public function pendingTasks()
    {
        return $this->tasks()->where('status', 'pending');
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCanceled(): bool
    {
        return $this->status === 'canceled';
    }

}
