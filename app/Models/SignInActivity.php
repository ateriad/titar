<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\SignInActivity
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property string $ip
 * @property string $agent
 * @property Carbon $created_at
 * @method static Builder|SignInActivity newModelQuery()
 * @method static Builder|SignInActivity newQuery()
 * @method static Builder|SignInActivity query()
 * @method static Builder|SignInActivity whereAgent($value)
 * @method static Builder|SignInActivity whereCreatedAt($value)
 * @method static Builder|SignInActivity whereId($value)
 * @method static Builder|SignInActivity whereIp($value)
 * @method static Builder|SignInActivity whereType($value)
 * @method static Builder|SignInActivity whereUserId($value)
 * @mixin Eloquent
 * @property-read mixed $created_at_j
 */
class SignInActivity extends Model
{
    public function setUpdatedAt($value)
    {
        // DISABLED.
    }
}
