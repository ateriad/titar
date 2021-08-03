<?php

namespace App\Models;

use App\Enums\ReactionTypes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property int $type
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $created_at_j
 * @property-read \App\Models\Video $video
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Visit[] $visit
 * @property-read int|null $visit_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdVisit[] $adVisit
 * @property-read int|null $ad_visit_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdVisit[] $adVisits
 * @property-read int|null $ad_visits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Visit[] $visits
 * @property-read int|null $visits_count
 * @property-read \App\Models\Image $image
 */
class Product extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'id',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @return HasOne
     */
    public function video()
    {
        return $this->hasOne(Video::class);
    }

    /**
     * @return HasMany
     */
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return HasOne
     */
    public function event()
    {
        return $this->hasOne(Event::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    /**
     * @return HasMany
     */
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    /**
     * @return HasMany
     */
    public function adVisits()
    {
        return $this->hasMany(AdVisit::class);
    }

    /**
     * @return integer
     */
    public function likes()
    {
        $likes = 0;

        $reactions = Reaction::selectRaw('count(*) c, type')
            ->where('product_id', '=', $this->id)
            ->groupBy('type')
            ->get();

        foreach ($reactions as $reaction) {
            $reaction['type'] == ReactionTypes::LIKE && $likes++;
        }

        return $likes;
    }

    /**
     * @return integer
     */
    public function dislikes()
    {
        $dislikes = 0;

        $reactions = Reaction::selectRaw('count(*) c, type')
            ->where('product_id', '=', $this->id)
            ->groupBy('type')
            ->get();

        foreach ($reactions as $reaction) {
            $reaction['type'] == ReactionTypes::DISLIKE && $dislikes++;
        }

        return $dislikes;
    }
}
