<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'id_user',
        'name',
        'email',
        'subject',
        'message',
        'is_read',
        'is_replied',
        'replied_at',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'replied_at' => 'datetime',
        'is_read' => 'boolean',
        'is_replied' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class , 'id_user');
    }

}
