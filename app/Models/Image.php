<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property int $product_id
 * @property string $title
 * @property string $content
 * @property string|null $genre
 * @property int|null $year
 * @property string|null $publisher
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ImageAttribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ImageCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $created_at_j
 * @property-read \App\Models\Product $product
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image wherePublisher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Image withoutTrashed()
 * @mixin \Eloquent
 */
class Image extends Model
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
        return $this->hasMany(ImageAttribute::class);
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return string|null
     */
    public function attribute(string $key, ?string $value = null): ?string
    {
        /** @var ImageAttribute $attribute */
        $attribute = $this->attributes()
            ->where('image_id', '=', $this->id)
            ->where('key', '=', $key)
            ->firstOrNew([]);

        if ($value === null) {
            return $attribute ? $attribute->value : null;
        }

        $attribute->image_id = $this->id;
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
        return $this->belongsToMany(ImageCategory::class);
    }

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
