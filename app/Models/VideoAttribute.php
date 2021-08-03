<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\VideoAttribute
 *
 * @property int $id
 * @property int $video_id
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Video $video
 * @method static Builder|VideoAttribute newModelQuery()
 * @method static Builder|VideoAttribute newQuery()
 * @method static Builder|VideoAttribute query()
 * @method static Builder|VideoAttribute whereCreatedAt($value)
 * @method static Builder|VideoAttribute whereId($value)
 * @method static Builder|VideoAttribute whereKey($value)
 * @method static Builder|VideoAttribute whereUpdatedAt($value)
 * @method static Builder|VideoAttribute whereValue($value)
 * @method static Builder|VideoAttribute whereVideoId($value)
 * @mixin Eloquent
 * @property-read mixed $created_at_j
 */
class VideoAttribute extends Model
{
    protected $hidden = [
        'id',
        'video_id',
        'created_at',
        'updated_at',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
