<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'demande_id',
        'observation',
        'technicien_id',
        'status'
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }

    public function technicien()
    {
        return $this->belongsTo(User::class, 'technicien_id');
    }
}