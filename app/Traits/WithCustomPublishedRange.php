<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait WithCustomPublishedRange
{
    /**
     * Get custom timezone start date
     */
    protected function getPublishStartDateCustomAttribute($value)
    {
        return is_null($this->publish_start_date) ? null : Carbon::parse($this->publish_start_date)->shiftTimezone('UTC')->setTimezone('Europe/Ljubljana');
    }

    /**
     * Get custom timezone end date
     */
    protected function getPublishEndDateCustomAttribute($value)
    {
        return is_null($this->publish_end_date) ? null : Carbon::parse($this->publish_end_date)->shiftTimezone('UTC')->setTimezone('Europe/Ljubljana');
    }
}
