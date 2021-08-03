<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property int $author_id
 * @property int $product_id
 * @property string $title
 * @property string $content
 * @property string $publisher
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|EventAttribute[] $attributes
 * @property-read int|null $attributes_count
 * @property-read Collection|EventCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $created_at_j
 * @property-read Product $product
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static Builder|Event onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event wherePublisher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static Builder|Event withTrashed()
 * @method static Builder|Event withoutTrashed()
 * @mixin Eloquent
 */
class Event extends Model
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
        return $this->hasMany(EventAttribute::class);
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return string|null
     */
    public function attribute(string $key, ?string $value = null): ?string
    {
        /** @var EventAttribute $attribute */
        $attribute = $this->attributes()
            ->where('event_id', '=', $this->id)
            ->where('key', '=', $key)
            ->firstOrNew([]);

        if ($value === null) {
            return $attribute ? $attribute->value : null;
        }

        $attribute->event_id = $this->id;
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
        return $this->belongsToMany(EventCategory::class, 'event_event_categories');
    }

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
