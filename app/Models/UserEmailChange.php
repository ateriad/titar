<?php

namespace App\Models;

/**
 * App\Models\UserEmailChange
 *
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $created_at_j
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailChange newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailChange newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailChange query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailChange whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailChange whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailChange whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailChange whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailChange whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserEmailChange whereUserId($value)
 * @mixin \Eloquent
 */
class UserEmailChange extends Model
{

}
