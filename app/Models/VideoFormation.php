<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoFormation extends Model
{
    use HasFactory;

    protected $table = 'videos_formation';

    protected $fillable = [
        'id_module',  // Identifiant du module associé
        'titre',      // Titre de la vidéo de formation
        'url',        // URL de la vidéo
        'duree',      // Durée de la vidéo
        'ordre',      // Ordre d'affichage des vidéos dans un module
    ];

    /**
     * Définit la relation entre la vidéo de formation et le module associé.
     */
    public function module()
    {
        return $this->belongsTo(Module::class, 'id_module');
    }
}
