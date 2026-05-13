<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $contract_id
 * @property string $day_of_week
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Day whereUpdatedAt($value)
 * @mixin \Eloquent
 */
#[Guarded([])]
class Day extends Model
{
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
