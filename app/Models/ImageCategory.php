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
 * App\Models\ImageCategory
 *
 * @property int $id
 * @property int $parent_id
 * @property int|null $position
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ImageCategory[] $children
 * @property-read int|null $children_count
 * @property-read mixed $created_at_j
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\ImageCategory $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Slide[] $slides
 * @property-read int|null $slides_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImageCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImageCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ImageCategory withoutTrashed()
 * @mixin \Eloquent
 */
class ImageCategory extends Model
{
    use SoftDeletes;

    public $fillable = ['title', 'parent_id', 'description', 'image', 'position'];

    /**
     * @return BelongsToMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }
}
