<?php

namespace App\Models;

use Illuminate\database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $contract_id
 * @property string $target_date
 * @property bool $conquered
 * @property string|null $logged_excuse
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog whereConquered($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog whereLoggedExcuse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog whereTargetDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountabilityLog whereUserId($value)
 *
 * @property-read Collection<int, ScheduledNudge> $scheduledNudges
 * @property-read int|null $scheduled_nudges_count
 * @property-read User $user
 *
 * @mixin \Eloquent
 */
#[Guarded([])]
class AccountabilityLog extends Model
{
    protected function casts(): array
    {
        return [

        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function scheduledNudges()
    {
        return $this->hasMany(ScheduledNudge::class);
    }
}
