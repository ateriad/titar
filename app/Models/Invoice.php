<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property string $gateway
 * @property mixed|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $created_at_j
 * @property-read \App\Models\Transaction $transaction
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Invoice whereUserId($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }
}
