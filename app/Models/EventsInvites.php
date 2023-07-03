<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsInvites extends Model
{
    use HasFactory;

    protected $fillable =['title', 'user_id', 'friend_id', 'start_date', 'end_date', 'done', 'color', 'group'];


    public function color()
    {
        return $this->belongsTo(Color::class, 'color');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'color');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
