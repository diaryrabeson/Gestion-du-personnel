<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
       protected $fillable = ['user_id', 'message', 'is_read'];

    public $timestamps = true;
}
