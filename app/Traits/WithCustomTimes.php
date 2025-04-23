<?php

namespace App\Traits;

use Illuminate\Support\Carbon;

trait WithCustomTimes
{
    /**
     * Save custom times into publish_* fields.
     */
    public function prepareFieldsBeforeSave($object, $fields): array
    {
        if (($fields['start_time'] ?? null) && ($fields['publish_start_date'] ?? null)) {
            $startTime = new Carbon($fields['start_time']);
            $fields['publish_start_date'] = (new Carbon($fields['publish_start_date']))->setTimeFrom($startTime)->toDateTimeString();
        }
        if (($fields['end_time'] ?? null) && ($fields['publish_end_date'] ?? null)) {
            $endTime = new Carbon($fields['end_time']);
            $fields['publish_end_date'] = (new Carbon($fields['publish_end_date']))->setTimeFrom($endTime)->toDateTimeString();
        }

        return parent:: prepareFieldsBeforeSave($object, $fields);
    }
}
