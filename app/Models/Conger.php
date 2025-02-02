<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeConger;
use App\Models\Employer;

class Conger extends Model
{
    use HasFactory;
     protected $table = 'conger';
    protected $primaryKey = 'id_Conge';

    protected $fillable = [
        'id_typeConge',
        'Date_debut',
        'Date_Fin',
        'Id_Employe',
        'status',
        'jours_ouvrables',
        'commentaire',
    ];

     public function typeConge()
    {
        return $this->belongsTo(TypeConger::class, 'id_typeConge'); // La clé étrangère doit correspondre au champ dans la table
    }

    public function employers()
    {
       return $this->belongsTo(Employer::class, 'Id_Employe');
    }

    
}
