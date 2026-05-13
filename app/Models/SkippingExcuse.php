<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $workout_detail_id
 * @property string $excuse
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkippingExcuse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkippingExcuse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkippingExcuse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkippingExcuse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkippingExcuse whereExcuse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkippingExcuse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkippingExcuse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SkippingExcuse whereWorkoutDetailId($value)
 * @mixin \Eloquent
 */
#[Guarded([])]
class SkippingExcuse extends Model
{
    public function workoutDetail()
    {
        return $this->belongsTo(WorkoutDetail::class);
    }
}
