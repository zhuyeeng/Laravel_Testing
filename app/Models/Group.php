<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'owner_id',
        'last_message_id'
    ];

    public function users()
    {
        return $this->belongsToMany(Group::class, 'group_users');
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
