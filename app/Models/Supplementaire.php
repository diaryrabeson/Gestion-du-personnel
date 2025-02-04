<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employer;

class Supplementaire extends Model
{
    use HasFactory;

protected $table = 'tb_supplementaire';
    protected $primaryKey = 'id_supplementaire';
    public $timestamps = true;

    protected $fillable = [
        'DateSys',
        'CoutParHeure',
        'DebutDeSuppl',
        'FinDeSuppl',
        'nb_total_heures',
        'cout_total',
        'Id_Employe',
    ];

    public function employer() {
        return $this->belongsTo(Employer::class, 'Id_Employe');
    }
}
