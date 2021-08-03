<?php

namespace App\Models;

use Eloquent;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $cellphone
 * @property \Illuminate\Support\Carbon|null $cellphone_verified_at
 * @property string|null $password
 * @property int $balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdVisit[] $adVisits
 * @property-read int|null $ad_visits_count
 * @property-read mixed $created_at_j
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Visit[] $visits
 * @property-read int|null $visits_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCellphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCellphoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $hidden = [
        'password',
        'email_verified_at',
        'cellphone_verified_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'cellphone_verified_at' => 'datetime',
    ];

    public $appends = [
        'created_at_j',
    ];

    public function getCreatedAtJAttribute()
    {
        return isset($this->created_at) ? jDate($this->created_at) : null;
    }

    /**
     * @inheritDoc
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * @param int $roleId
     * @return bool
     */
    public function hasRole($roleId): bool
    {
        foreach ($this->roles as $role) {
            if ($role->id == $roleId) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        foreach ($this->roles as $role) {
            foreach ($role->permissions() as $p) {
                if ($p == 'super-admin' || $p == $permission) {
                    return true;
                }
            }
        }

        return false;
    }

    public function isAdmin(): bool
    {
        return $this->roles()->count() > 0;
    }

    public function isSuperAdmin(): bool
    {
        $this->load('roles');

        foreach ($this->roles as $role) {
            foreach ($role->permissions() as $permission) {
                if ($permission == 'super-admin') {
                    return true;
                }
            }
        }

        return false;
    }

    public function fullName(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);

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
}
