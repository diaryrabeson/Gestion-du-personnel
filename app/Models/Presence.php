<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $table = 'presence';
    protected $primaryKey = 'id_presence';

    protected $fillable = [
        'DateSys',
        'Etat',
        'Id_Employe',
        'motif',
    ];

    public function employe()
    {
        return $this->belongsTo(Employer::class, 'Id_Employe', 'Id_Employe');
    }
}
