<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationUser extends Model
{
    use HasFactory;

    protected $table = 'application_user'; // Nom de la table pivot

    protected $fillable = [
        'user_id',
        'application_id',
    ];

    // Définition de la relation Many-to-Many
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}

