<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Slide
 *
 * @property int $id
 * @property int $product_type
 * @property string $image
 * @property string $link
 * @property string $title
 * @property string $description
 * @property string $button
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string|null $image_mobile
 * @property int $category_id
 * @property-read VideoCategory $category
 * @property-read mixed $created_at_j
 * @method static bool|null forceDelete()
 * @method static Builder|Slide newModelQuery()
 * @method static Builder|Slide newQuery()
 * @method static \Illuminate\Database\Query\Builder|Slide onlyTrashed()
 * @method static Builder|Slide query()
 * @method static bool|null restore()
 * @method static Builder|Slide whereButton($value)
 * @method static Builder|Slide whereCategoryId($value)
 * @method static Builder|Slide whereCreatedAt($value)
 * @method static Builder|Slide whereDeletedAt($value)
 * @method static Builder|Slide whereDescription($value)
 * @method static Builder|Slide whereId($value)
 * @method static Builder|Slide whereImage($value)
 * @method static Builder|Slide whereImageMobile($value)
 * @method static Builder|Slide whereLink($value)
 * @method static Builder|Slide whereProductType($value)
 * @method static Builder|Slide whereTitle($value)
 * @method static Builder|Slide whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Slide withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Slide withoutTrashed()
 * @mixin Eloquent
 */
class Slide extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at' ,'deleted_at'];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(VideoCategory::class);
    }
}
