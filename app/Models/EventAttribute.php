<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\EventAttribute
 *
 * @property int $id
 * @property int $event_id
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Event $event
 * @property-read mixed $created_at_j
 * @method static Builder|EventAttribute newModelQuery()
 * @method static Builder|EventAttribute newQuery()
 * @method static Builder|EventAttribute query()
 * @method static Builder|EventAttribute whereCreatedAt($value)
 * @method static Builder|EventAttribute whereEventId($value)
 * @method static Builder|EventAttribute whereId($value)
 * @method static Builder|EventAttribute whereKey($value)
 * @method static Builder|EventAttribute whereUpdatedAt($value)
 * @method static Builder|EventAttribute whereValue($value)
 * @mixin Eloquent
 */
class EventAttribute extends Model
{
    protected $hidden = [
        'id',
        'event_id',
        'created_at',
        'updated_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
