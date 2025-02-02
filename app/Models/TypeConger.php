<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeConger extends Model
{
    use HasFactory;
    protected $table = 'typeConger'; // Nom de la table
    protected $primaryKey = 'id_typeConge'; // Clé primaire
    public $timestamps = true; //
    protected $fillable = ['typeConge']; // Attributs modifiables
}
