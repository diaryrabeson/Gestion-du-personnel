<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheDePaye extends Model
{
    use HasFactory;

    protected $table = 'ficheDePaye';
    protected $primaryKey = 'id_fiche';

    protected $fillable = [
        'id_employe', 'id_presence', 'id_supplementaire', 
        'salaire_base', 'prime', 'total_heures_supp', 
        'total_presence', 'salaire_total'
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'Id_Employe');
    }

    public function presence()
    {
        return $this->belongsTo(Presence::class, 'id_presence');
    }

    public function supplementaire()
    {
        return $this->belongsTo(TbSupplementaire::class, 'id_supplementaire');
    }
}
