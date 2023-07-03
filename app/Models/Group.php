<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable =['title', 'color'];

    public function events()
    {
        return $this->hasMany(Event::class, 'group', 'id');
    }
}
