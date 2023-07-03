<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable =['title', 'user_id', 'start_date', 'end_date', 'done', 'color', 'group', 'freq', 'interval', 'byweekday', 'duration', 'dtstart', 'until'];

    public function messages()
    {
        return $this->hasMany(MessagesTelegram::class, 'event_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'color');
    }

}
