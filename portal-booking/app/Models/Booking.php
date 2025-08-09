<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $table = 'booking';
    protected $fillable = ['user_id', 'room_id', 'title', 'start_time', 'end_time'];
}
