<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Advertisement
 *
 * @property int $id
 * @property string $title
 * @property string $video
 * @property string $url
 * @property int $status
 * @property string|null $from
 * @property string|null $to
 * @property int|null $count
 * @property int $skippable
 * @property int|null $length
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $created_at_j
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertisement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereSkippable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Advertisement whereVideo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertisement withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Advertisement withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdVisit[] $adVisit
 * @property-read int|null $ad_visit_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdVisit[] $adVisits
 * @property-read int|null $ad_visits_count
 */
class Advertisement extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return HasMany
     */
    public function adVisits()
    {
        return $this->hasMany(AdVisit::class);
    }
}
