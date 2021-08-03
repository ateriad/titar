<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property Carbon|null $start
 * @property Carbon|null $end
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $created_at_j
 * @property-read mixed $end_j
 * @property-read mixed $start_j
 * @property-read User $user
 * @method static Builder|Subscription newModelQuery()
 * @method static Builder|Subscription newQuery()
 * @method static Builder|Subscription query()
 * @method static Builder|Subscription whereCreatedAt($value)
 * @method static Builder|Subscription whereDeletedAt($value)
 * @method static Builder|Subscription whereEnd($value)
 * @method static Builder|Subscription whereId($value)
 * @method static Builder|Subscription wherePrice($value)
 * @method static Builder|Subscription whereStart($value)
 * @method static Builder|Subscription whereType($value)
 * @method static Builder|Subscription whereUpdatedAt($value)
 * @method static Builder|Subscription whereUserId($value)
 * @mixin Eloquent
 */
class Subscription extends Model
{
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStartJAttribute()
    {
        return isset($this->start) ? jDate($this->start, 'yyyy-MM-dd') : null;
    }

    public function getEndJAttribute()
    {
        return isset($this->end) ? jDate($this->end, 'yyyy-MM-dd') : null;
    }
}
