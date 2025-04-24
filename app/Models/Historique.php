<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $fillable = [
        'demande_id',
        'status',
        'comment'
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
}
