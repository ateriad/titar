<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Video
 *
 * @property int $id
 * @property int $product_id
 * @property string $title
 * @property string $content
 * @property string|null $publisher
 * @property int|null $year
 * @property string|null $genre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VideoAttribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VideoCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $created_at_j
 * @property-read \App\Models\Product $product
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Video onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video wherePublisher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Video withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Video withoutTrashed()
 * @mixin \Eloquent
 * @property int $author_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereAuthorId($value)
 */
class Video extends Model
{
    use SoftDeletes;

    public $appends = [
        'created_at_j',
    ];

    /**
     * @return HasMany
     */
    public function attributes()
    {
        return $this->hasMany(VideoAttribute::class);
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return string|null
     */
    public function attribute(string $key, ?string $value = null): ?string
    {
        /** @var VideoAttribute $attribute */
        $attribute = $this->attributes()
            ->where('video_id', '=', $this->id)
            ->where('key', '=', $key)
            ->firstOrNew([]);

        if ($value === null) {
            return $attribute ? $attribute->value : null;
        }

        $attribute->video_id = $this->id;
        $attribute->key = $key;
        $attribute->value = $value;
        $attribute->save();

        return $value;
    }

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(VideoCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
