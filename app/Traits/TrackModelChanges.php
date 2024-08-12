<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait TrackModelChanges
{
    /**
     * Track the changes made to a model and return the details.
     */
    public function findChanges(Model $model): string
    {
        $original = $model->getOriginal();
        $changes = $model->getChanges();
        $updatedFields = [];
        foreach ($changes as $key => $value) {
            if (Arr::has($original, $key) && $original[$key] != $value) {
                $updatedFields[] = "{$key} changed from '{$original[$key]}' to '{$value}'";
            }
        }

        return implode(', ', $updatedFields);
    }
}
