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
 * App\Models\EventCategory
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
 * @property-read Collection|EventCategory[] $children
 * @property-read int|null $children_count
 * @property-read Collection|Event[] $events
 * @property-read int|null $events_count
 * @property-read mixed $created_at_j
 * @property-read EventCategory $parent
 * @property-read Collection|Slide[] $slides
 * @property-read int|null $slides_count
 * @method static bool|null forceDelete()
 * @method static Builder|EventCategory newModelQuery()
 * @method static Builder|EventCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|EventCategory onlyTrashed()
 * @method static Builder|EventCategory query()
 * @method static bool|null restore()
 * @method static Builder|EventCategory whereCreatedAt($value)
 * @method static Builder|EventCategory whereDeletedAt($value)
 * @method static Builder|EventCategory whereDescription($value)
 * @method static Builder|EventCategory whereId($value)
 * @method static Builder|EventCategory whereImage($value)
 * @method static Builder|EventCategory whereParentId($value)
 * @method static Builder|EventCategory wherePosition($value)
 * @method static Builder|EventCategory whereTitle($value)
 * @method static Builder|EventCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|EventCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|EventCategory withoutTrashed()
 * @mixin Eloquent
 */
class EventCategory extends Model
{
    use SoftDeletes;

    public $fillable = ['title', 'parent_id', 'description', 'image', 'position'];

    /**
     * @return BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_event_categories');
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
