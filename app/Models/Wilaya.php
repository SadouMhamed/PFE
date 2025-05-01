<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'wilaya_name',
        // add other fields as needed
    ];

    // Relationship with BureauDePoste if needed
    public function bureauDePostes()
    {
        return $this->hasMany(BureauDePoste::class);
    }
}
