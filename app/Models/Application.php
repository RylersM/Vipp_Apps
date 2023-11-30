<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',           // Identifiant unique de l'application
        'nom',            // Nom de l'application
        'description',    // Description de l'application
        'capture_ecran',  // Chemin vers les captures d'écran de l'application (peut être nullable)
        'video_demo',     // Chemin vers la vidéo de démonstration de l'application (peut être nullable)
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
