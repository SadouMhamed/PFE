<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $fillable = [
        'trackable_type',
        'trackable_id',
        'old_status',
        'new_status',
        'changed_by',
        'comments'
    ];

    public function trackable()
    {
        return $this->morphTo();
    }
}