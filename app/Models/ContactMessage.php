<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ContactMessage
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read mixed $created_at_j
 * @method static bool|null forceDelete()
 * @method static Builder|ContactMessage newModelQuery()
 * @method static Builder|ContactMessage newQuery()
 * @method static \Illuminate\Database\Query\Builder|ContactMessage onlyTrashed()
 * @method static Builder|ContactMessage query()
 * @method static bool|null restore()
 * @method static Builder|ContactMessage whereContent($value)
 * @method static Builder|ContactMessage whereCreatedAt($value)
 * @method static Builder|ContactMessage whereDeletedAt($value)
 * @method static Builder|ContactMessage whereEmail($value)
 * @method static Builder|ContactMessage whereId($value)
 * @method static Builder|ContactMessage whereName($value)
 * @method static Builder|ContactMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ContactMessage withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ContactMessage withoutTrashed()
 * @mixin Eloquent
 */
class ContactMessage extends Model
{
    use SoftDeletes;
}
