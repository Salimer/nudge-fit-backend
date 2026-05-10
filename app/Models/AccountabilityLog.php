<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $contract_id
 * @property string $target_date
 * @property bool $conquered
 * @property string|null $logged_excuse
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
 * @mixin \Eloquent
 */
class AccountabilityLog extends Model
{
    //
}
