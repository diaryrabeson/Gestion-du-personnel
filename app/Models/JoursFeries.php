<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoursFeries extends Model
{
    use HasFactory;

    protected $table = 'jours_feries';
    protected $primaryKey = 'id_jour_ferie';

    protected $fillable = [
        'date',
        'description',
    ];
}
