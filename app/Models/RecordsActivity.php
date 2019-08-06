<?php

namespace App\Models;


trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        foreach (static::getActivityToRecord() as $event) {
            static::$event(function ($model) use ($event){
                $model->recordActivity($event);
            });
        }
    }

    protected static function getActivityToRecord()
    {
        return ['created'];
    }

    protected function recordActivity($event)
    {
        Activity::create([
            'type' => $this->getActivityType($event),
            'subject_id' => $this ->id,
            'subject_type' => get_class($this)
        ]);
    }

    protected function activity()
    {
        return $this->morphMany('App\Models\Activity', 'subject');
    }

    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";

    }
}