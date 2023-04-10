<?php

namespace App\Traits;

use Spatie\Activitylog\LogOptions;

trait ModelLogger
{
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()
                         ->logOnlyDirty()
                         ->dontSubmitEmptyLogs();
        // Chain fluent methods for configuration options
    }
}
