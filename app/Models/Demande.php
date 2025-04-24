<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'typeProbleme',
        'description',
        'statut',
        'user_id',
        'bureau_de_poste_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bureauDePoste()
    {
        return $this->belongsTo(BureauDePoste::class, 'bureau_de_poste_id', 'id');
    }

    public function historiques()
    {
        return $this->hasMany(Historique::class);
    }
}
