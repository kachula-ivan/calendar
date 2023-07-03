<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessagesTelegram extends Model
{
    use HasFactory;

    protected $fillable =['telegram_id', 'event_id', 'title', 'start_date', 'end_date', 'start_message', 'end_message'];
}
