<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'tb_service';
    protected $primaryKey = 'id_service';
    protected $fillable = ['nomService', 'Description'];
}


// teste pour le merge