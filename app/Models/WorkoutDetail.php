<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $coach_tone
 * @property string|null $workout_style
 * @property string|null $equipment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail whereCoachTone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail whereEquipment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutDetail whereWorkoutStyle($value)
 * @mixin \Eloquent
 */
class WorkoutDetail extends Model
{
    //
}
