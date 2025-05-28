<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conger;
use App\Models\Service;
class Employer extends Model
{
    use HasFactory;


    // Nom de la table dans la base de données
    protected $table = 'employers';

     // Clé primaire de la table
    protected $primaryKey = 'Id_Employe';


     // Les colonnes pouvant être remplies via un formulaire
    protected $fillable = [
        'NomEmp',
        'Prenom',
        'Adresse',
        'mail',
        'Telephone',
        'Photo',
        'DatedeNaissance',
        'DateD_embauche',
        'Id_service',
        'Service',
        'SoldeConger',
        'Genre',
        'SalaireDeBase',
    ];


// App\Models\Employe.php
public function conges()
{
    return $this->hasMany(Conger::class, 'Id_Employe', 'id_Employe');
}
public function service()
{
    return $this->belongsTo(\App\Models\Service::class, 'Id_service', 'Id_service');
}
}
