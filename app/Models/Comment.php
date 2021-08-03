<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property string $content
 * @property string|null $meta
 * @property int $is_accepted
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read mixed $created_at_j
 * @property-read Product $product
 * @property-read User $user
 * @method static bool|null forceDelete()
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Comment onlyTrashed()
 * @method static Builder|Comment query()
 * @method static bool|null restore()
 * @method static Builder|Comment whereContent($value)
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereDeletedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereIsAccepted($value)
 * @method static Builder|Comment whereMeta($value)
 * @method static Builder|Comment whereProductId($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @method static Builder|Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Comment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Comment withoutTrashed()
 * @mixin Eloquent
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'meta',
    ];

    public $appends = [
        'created_at_j',
    ];

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
