<?php

namespace App\Traits;

use App\Models\StatusHistory;

trait HasStatusHistory
{
    protected static function bootHasStatusHistory()
    {
        static::updating(function ($model) {
            if ($model->isDirty('status')) {
                StatusHistory::create([
                    'trackable_type' => get_class($model),
                    'trackable_id' => $model->id,
                    'old_status' => $model->getOriginal('status'),
                    'new_status' => $model->status,
                    'changed_by' => auth()->user()->name,
                    'comments' => request('comments')
                ]);
            }
        });
    }

    public function statusHistories()
    {
        return $this->morphMany(StatusHistory::class, 'trackable');
    }
}