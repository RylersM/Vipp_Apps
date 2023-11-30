<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_application', // Identifiant de l'application associée
        'titre',          // Titre de la formation
        'description',    // Description de la formation
    ];

    /**
     * Définit la relation entre la formation et l'application associée.
     */
    public function application()
    {
        return $this->belongsTo(Application::class, 'id_application');
    }

    /**
     * Définit la relation entre la formation et ses modules.
     */
    public function modules()
    {
        return $this->hasMany(Module::class, 'id_formation');
    }
}
