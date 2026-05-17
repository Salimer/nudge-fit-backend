<?php

namespace App\DTOs;

readonly class DayNudgesPayloadDTO
{
    public function __construct(
        public NudgePayloadDTO $primer,
        public NudgePayloadDTO $trigger,
        public NudgePayloadDTO $consequence,
    ) {}
}
