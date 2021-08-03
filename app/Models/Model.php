<?php

namespace App\Models;

use DateTimeInterface;

abstract class Model extends \Illuminate\Database\Eloquent\Model
{
    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    public function getCreatedAtJAttribute()
    {
        return isset($this->created_at) ? jDate($this->created_at) : null;
    }

    /**
     * @inheritDoc
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
