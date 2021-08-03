<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $title
 * @property mixed $permissions
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static bool|null forceDelete()
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static \Illuminate\Database\Query\Builder|Role onlyTrashed()
 * @method static Builder|Role query()
 * @method static bool|null restore()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereDeletedAt($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role wherePermissions($value)
 * @method static Builder|Role whereTitle($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Role withoutTrashed()
 * @mixin Eloquent
 * @property-read mixed $created_at_j
 */
class Role extends Model
{
    use SoftDeletes;

    public $fillable = ['title'];

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return string[]
     */
    public function permissions(): array
    {
        return json_decode($this->permissions ?? '[]');
    }
}
