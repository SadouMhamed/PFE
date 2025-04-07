<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BureauDePoste extends Model
{
    use HasFactory;

    protected $table = 'Bureau_de_poste';
    protected $fillable = ['intitule_fr'];

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'bureau_de_poste_id', 'id');
    }
}