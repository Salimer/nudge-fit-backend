<?php

namespace App\DTOs;

readonly class NudgePayloadDTO
{
    public function __construct(
        public string $title,
        public string $body,
        public string $inApp,
    ) {}
}
