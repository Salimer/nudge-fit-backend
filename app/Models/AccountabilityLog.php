<?php

namespace App\Models;

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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ScheduledNudge> $scheduledNudges
 * @property-read int|null $scheduled_nudges_count
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class AccountabilityLog extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scheduledNudges()
    {
        return $this->hasMany(ScheduledNudge::class);
    }
}
