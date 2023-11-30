<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationUser extends Model
{
    protected $table = 'formation_user';

    public $timestamps = false;

    protected $fillable = [
        'formation_id',
        'user_id',
    ];

    public function formations()
    {
        return $this->belongsToMany(Formation::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
