<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BureauDePoste extends Model
{
    protected $table = 'bureau_de_postes';
    public $timestamps = true;
    
    protected $fillable = [
        'code',
        'intitule_fr',
        'intitule_ar'
    ];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}