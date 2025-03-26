<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'expediteur_id',
        'destinataire_id',
        'contenu',
        'file'
    ];

    // Relation avec l'expéditeur
    public function expediteur()
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    // Relation avec le destinataire
    public function destinataire()
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }
}
