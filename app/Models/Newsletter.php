<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Newsletter
 *
 * @property int $id
 * @property string $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read mixed $created_at_j
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter newQuery()
 * @method static Builder|Newsletter onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereUpdatedAt($value)
 * @method static Builder|Newsletter withTrashed()
 * @method static Builder|Newsletter withoutTrashed()
 * @mixin Eloquent
 */
class Newsletter extends Model
{
    use SoftDeletes;
}
