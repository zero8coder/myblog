<?php

namespace App\Models;


trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        static::created(function ($article){
            $article->recordActivity('created');
        });
    }

    protected function recordActivity($event)
    {
        Activity::create([
            'type' => $this->getActivityType($event),
            'subject_id' => $this ->id,
            'subject_type' => get_class($this)
        ]);
    }

    protected function getActivityType($event)
    {
        return $event . '_' . strtolower((new \ReflectionClass($this))->getShortName());
    }
}
