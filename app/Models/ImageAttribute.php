<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\ImageAttribute
 *
 * @property int $id
 * @property int $image_id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $created_at_j
 * @property-read \App\Models\Image $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageAttribute whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageAttribute whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ImageAttribute whereValue($value)
 * @mixin \Eloquent
 */
class ImageAttribute extends Model
{
    protected $hidden = [
        'id',
        'image_id',
        'created_at',
        'updated_at',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
