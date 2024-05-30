<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'publie_le', 'publie_par', 'extension', 'type_document', 'etat', 'description', 'nombre_vue', 'fichier'
    ];
}
