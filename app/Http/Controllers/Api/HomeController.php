<?php

namespace App\Http\Controllers\Api;

use App\Enums\ContractStatusEnum;
use App\Enums\HomeStateEnum;
use App\Enums\NudgeStatusEnum;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if (! $user->contract || $user->contract->status === ContractStatusEnum::Disabled) {
            return response()->json([
                'state' => HomeStateEnum::setupRequired,
                'title' => '',
                'message' => '',
            ]);
        }

        $userNow = Carbon::now($user->timezone);

        // 1. Fetch ONLY today's log. We ignore the past (no accountability debt for now).
        $log = $user->accountabilityLogs()
            ->where('target_date', $userNow->toDateString())
            ->first();

        // STATE 1: Rest Day (no log exists for today)
        if (! $log) {
            return response()->json([
                'state' => HomeStateEnum::restDay,
                'title' => 'Rest Up',
                'message' => '',
            ]);
        }

        // STATE 2: Conquered (They already slid the "Start" button today)
        if ($log->conquered) {
            return response()->json([
                'state' => HomeStateEnum::completed,
                'title' => '',
                'message' => '',
            ]);
        }

        // STATE 3: Skipped
        // If the user clicked the skip button and logged an excuse
        if ($log->logged_excuse) {
            return response()->json([
                'state' => HomeStateEnum::skipped,
                'title' => '',
                'message' => '',
            ]);
        }

        // STATE 4: Action Required (Pending Workout)
        // Fetch latest "sent" nudge to show the AI's current context on the screen
        $latestNudge = $log->scheduledNudges()
            ->where('status', NudgeStatusEnum::Sent)
            ->latest('target_time')
            ->first();

        // If no nudges have fired yet or it is their day one soft landing
        // use a fallback
        $inAppMessage = $latestNudge
        ? $latestNudge->in_app_message
        : 'The contract is locked in. Be ready.';

        // Format the target time nicely for the UI
        $targetTimeFormatted = Carbon::parse($user->contract->target_time)->format('h:i A');

        return response()->json([
            'state' => HomeStateEnum::actionRequired,
            'target_time' => $targetTimeFormatted,
            'title' => '',
            'in_app_message' => $inAppMessage,
        ]);

    }
}
