<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\AdVisit
 *
 * @property int $id
 * @property int $product_id
 * @property string $ip
 * @property int|null $source
 * @property int $user_id
 * @property int $advertisement_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Advertisement $advertisement
 * @property-read mixed $created_at_j
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit whereAdvertisementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdVisit whereUserId($value)
 * @mixin \Eloquent
 */
class AdVisit extends Model
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

    /**
     * @return BelongsTo
     */
    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}
