<?php

namespace App\Http\Controllers\Api;

use App\Enums\Locales;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnboardingData;
use App\Models\Contract;
use App\Models\WorkoutDetail;
use DB;
use Log;

class OnboardingController extends Controller
{
    public function onboard(StoreOnboardingData $request)
    {
        try {

            $user = $request->user();
            $data = $request->validated();

            DB::transaction(function () use ($user, $data) {
                // 1. Update the user
                $user->update([
                    'timezone' => $data['timezone'],
                    'locale' => $data['locale'] == 'ar' ? Locales::Arabic : Locales::English,
                ]);

                // 2. Setup the contract
                $contract = Contract::updateOrCreate([
                    'user_id' => $user->id,
                ], [
                    'target_time' => $data['target_time'],
                ]);

                // 3. Attach days to contract (clear old ones first if re-onboarding)
                $contract->days()->delete();

                // 4. Laravel's collect() helper makes mapping arrays beautifully clean
                $daysData = collect($data['days'])
                    ->map(fn ($day) => ['day_of_week' => $day])
                    ->toArray();

                $contract->days()->createMany($daysData);

                // 4. Setup workout details
                $workoutDetail = WorkoutDetail::updateOrCreate([
                    'user_id' => $user->id,
                ], [
                    'workout_style' => $data['workout_style'],
                    'equipment' => $data['equipment'],
                ]);

                // 5. Attach goals to workout details
                $goalsData = collect($data['goals'])
                    ->map(fn ($goal) => ['goal' => $goal])
                    ->toArray();

                $workoutDetail->goals()->createMany($goalsData);

                // 6. Attach skipping excuses to workout details
                $excusesData = collect($data['excuses'])
                    ->map(fn ($excuse) => ['excuse' => $excuse])
                    ->toArray();

                $workoutDetail->skippingExcuses()->createMany($excusesData);
            });

            return response()->json([
                'message' => 'Onboarding successfully completed.',
                'user' => $user,
            ]);
        } catch (\Throwable $e) {
            // 1. Log the error to the server
            Log::error("Onboarding failed for user {$request->user()->id}: ".$e->getMessage());

            // 2. Send a safe, clean JSON response to Flutter
            return response()->json([
                'message' => 'We hit a sang setting up your profile. Please try again.',
                // optional: Only send the raw error text if the app is in local dev mode
                'debug_error' => config('app.debug') ? $e->getMessage() : null,
            ], status: 500);
        }
    }
}
