<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $user_id
 * @property string $transactionable_type
 * @property int $transactionable_id
 * @property string $reference_id
 * @property string $card_number
 * @property int $type
 * @property int $amount
 * @property int $balance
 * @property mixed|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $created_at_j
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $transactionable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereTransactionableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUserId($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    public function transactionable()
    {
        return $this->morphTo();
    }
}
