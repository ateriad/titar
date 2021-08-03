<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Reaction
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property int $type
 * @property string|null $meta
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @property-read Video $video
 * @method static Builder|Reaction newModelQuery()
 * @method static Builder|Reaction newQuery()
 * @method static Builder|Reaction query()
 * @method static Builder|Reaction whereCreatedAt($value)
 * @method static Builder|Reaction whereId($value)
 * @method static Builder|Reaction whereMeta($value)
 * @method static Builder|Reaction whereProductId($value)
 * @method static Builder|Reaction whereType($value)
 * @method static Builder|Reaction whereUpdatedAt($value)
 * @method static Builder|Reaction whereUserId($value)
 * @mixin Eloquent
 * @property-read mixed $created_at_j
 */
class Reaction extends Model
{
    /**
     * @return BelongsTo
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
