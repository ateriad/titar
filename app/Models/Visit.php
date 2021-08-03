<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Visit
 *
 * @property int $id
 * @property int $product_id
 * @property string $ip
 * @property int|null $source
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $created_at_j
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visit whereUserId($value)
 * @mixin \Eloquent
 */
class Visit extends Model
{
    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
