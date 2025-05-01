<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    use HasFactory;
    
    protected $fillable = ['upw'];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    /**
     * Get the bureau de postes for this wilaya
     */
    public function bureauDePostes()
    {
        return $this->hasMany(BureauDePoste::class);
    }
}
