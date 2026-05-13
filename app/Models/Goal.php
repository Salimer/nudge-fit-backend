<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $workout_detail_id
 * @property string $goal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereWorkoutDetailId($value)
 * @mixin \Eloquent
 */
#[Guarded([])]
class Goal extends Model
{
    public function workoutDetail()
    {
        return $this->belongsTo(WorkoutDetail::class);
    }
}
