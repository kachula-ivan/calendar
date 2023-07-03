<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable =['title', 'color'];


    public function events()
    {
        return $this->hasMany(Event::class, 'color', 'id');
    }

    public function events_invites()
    {
        return $this->hasMany(Event::class, 'color', 'id');
    }



}
