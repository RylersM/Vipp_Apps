<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
       'id_formation',  // Identifiant de la formation associée
       'titre',         // Titre du module
    ];

    /**
     * Définit la relation entre le module et la formation associée.
     */
    public function formation()
    {
        return $this->belongsTo(Formation::class, 'id_formation');
    }

    /**
     * Définit la relation entre le module et ses vidéos.
     */
    public function videos()
    {
        return $this->hasMany(VideoFormation::class, 'id_module')->orderBy('ordre');
    }
}
