<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $accountability_log_id
 * @property string $nudge_type
 * @property string $target_time
 * @property string $status
 * @property string $push_title
 * @property string $push_body
 * @property string $sender_name
 * @property string $in_app_message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge whereAccountabilityLogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge whereInAppMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge whereNudgeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge wherePushBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge wherePushTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge whereSenderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge whereTargetTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduledNudge whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ScheduledNudge extends Model
{
    //
}
