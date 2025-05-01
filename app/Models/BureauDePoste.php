<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BureauDePoste extends Model
{
    use HasFactory;

    protected $table = 'bureau_de_postes';
    public $timestamps = true;
    
    protected $fillable = [
        'brigade',
        'classe',
        'code',
        'code_commune',
        'commune',
        'cp',
        'daira',
        'etat',
        'intitule_ar',
        'intitule_fr',
        'upw',
        'upw_id',
        'wilaya',
        'wilaya_id'
    ];
    
    /**
     * Get the wilaya that this bureau de poste belongs to
     */
    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }
}