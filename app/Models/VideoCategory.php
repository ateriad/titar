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
 * App\Models\VideoCategory
 *
 * @property int $id
 * @property int $parent_id
 * @property int|null $position
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|VideoCategory[] $children
 * @property-read int|null $children_count
 * @property-read mixed $created_at_j
 * @property-read VideoCategory $parent
 * @property-read Collection|Slide[] $slides
 * @property-read int|null $slides_count
 * @property-read Collection|Video[] $videos
 * @property-read int|null $videos_count
 * @method static bool|null forceDelete()
 * @method static Builder|VideoCategory newModelQuery()
 * @method static Builder|VideoCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|VideoCategory onlyTrashed()
 * @method static Builder|VideoCategory query()
 * @method static bool|null restore()
 * @method static Builder|VideoCategory whereCreatedAt($value)
 * @method static Builder|VideoCategory whereDeletedAt($value)
 * @method static Builder|VideoCategory whereDescription($value)
 * @method static Builder|VideoCategory whereId($value)
 * @method static Builder|VideoCategory whereImage($value)
 * @method static Builder|VideoCategory whereParentId($value)
 * @method static Builder|VideoCategory wherePosition($value)
 * @method static Builder|VideoCategory whereTitle($value)
 * @method static Builder|VideoCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|VideoCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|VideoCategory withoutTrashed()
 * @mixin Eloquent
 */
class VideoCategory extends Model
{
    use SoftDeletes;

    public $fillable = ['title', 'parent_id', 'description', 'image', 'position'];

    /**
     * @return BelongsToMany
     */
    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

    /**
     * @return HasMany
     */
    public function slides()
    {
        return $this->hasMany(Slide::class);
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
