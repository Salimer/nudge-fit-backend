<?php

namespace App\Actions;

use App\DTOs\DayNudgesPayloadDTO;
use App\DTOs\NudgePayloadDTO;
use App\DTOs\NudgeTypesDTO;
use App\Enums\NudgeStatusEnum;
use App\Models\AccountabilityLog;
use App\Models\User;
use Carbon\Carbon;

use function in_array;

class GenerateDailyLogForUser
{
    /**
     * Executes the daily log generation for a specific user.
     *
     * @param  User  $user  The authenticated user
     * @param  Carbon  $userNow  The current time in the user's local timezone
     * @param  bool  $isFromOnboarding  True if calling directly after onboarding
     */
    public function execute(User $user, Carbon $userNow, bool $isFromOnboarding = false): ?AccountabilityLog
    {
        $todayString = strtoupper($userNow->format('D'));
        $contractedDays = $user->contract->days->pluck(value: 'day_of_week')->toArray();

        // 1. Is today a contract day? If not, do nothing
        if (! in_array(needle: $todayString, haystack: $contractedDays)) {
            return null;
        }

        $targetTime = Carbon::parse($user->contract->target_time, $user->timezone);
        $targetTime->setDate($userNow->year, $userNow->month, $userNow->day);

        // 2. Generate the Log
        // The log is created strictly because today is a contract day
        $log = AccountabilityLog::firstOrCreate([
            'user_id' => $user->id,
            'contract_id' => $user->contract->id,
            'target_date' => $userNow->toDateString(),
        ], [
            'conquered' => false,
        ]);

        if ($isFromOnboarding) {
            return $log;
        }

        $times = $this->calculateNudgeTimes(target: $targetTime, userNow: $userNow);
        // TODO: Replace this mock array with the actual call to your Gemini Service
        $geminiPayload = new DayNudgesPayloadDTO(
            primer: new NudgePayloadDTO(
                title: 'Preparation',
                body: '',
                inApp: '',
            ),
            trigger: new NudgePayloadDTO(
                title: 'Preparation',
                body: '',
                inApp: '',
            ),
            consequence: new NudgePayloadDTO(
                title: 'Preparation',
                body: '',
                inApp: '',
            ),
        );

        foreach ($geminiPayload as $type => $nudge) {
            $log->scheduledNudges()->firstOrCreate(attributes: [
                'nudge_type' => $type,
            ], values: [
                'target_time' => $times->$type->toTimeString(),
                'status' => NudgeStatusEnum::Pending,
                'push_title' => $nudge->title,
                'push_body' => $nudge->body,
                'in_app_message' => $nudge->inApp,
                'sender_name' => 'Gemini',

            ]);
        }

        return $log;
    }

    /**
     * Calculates the exact times for the 3 daily nudges, compressing edge cases
     * to prevent scheduling times in the past.
     *
     * @param  Carbon  $target  The user's contract time for today
     * @param  Carbon  $userNow  The current time in the user's timezone
     */
    private function calculateNudgeTimes(Carbon $target, Carbon $userNow): NudgeTypesDTO
    {
        $primer = (clone $target)->subHours(3);
        $trigger = (clone $target)->subMinutes(10);
        $consequence = (clone $target)->addHour();

        $startOfDay = (clone $userNow)->startOfDay();
        $endOfDay = (clone $userNow)->setTime(hour: 23, minute: 59, second: 0);

        // Edge Case 1: Target is 01:00 AM. Primer math equals 10:00 PM yesterday.
        // Compress it to 00:15 today.
        if ($primer->isBefore($startOfDay)) {
            $primer = clone $startOfDay->addMinutes(value: 15);
        }

        // Edge Case 2: Target is 00:05 AM. Trigger math equals 11:55 PM yesterday.
        // Compress it to 00:01 today.
        if ($trigger->isBefore($startOfDay)) {
            $trigger = clone $startOfDay->addMinutes(value: 1);
        }

        // Edge Case 3: Target is 23:40. Consequence math = 00:40 tomorrow.
        // Compress it so it fires at exactly 23:50 tonight.
        if ($consequence->isAfter($endOfDay)) {
            $consequence = clone $endOfDay->subMinutes(value: 10);
        }

        return new NudgeTypesDTO(
            primer: $primer,
            trigger: $trigger,
            consequence: $consequence,
        );
    }
}
