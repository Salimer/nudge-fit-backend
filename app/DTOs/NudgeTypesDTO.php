<?php

namespace App\DTOs;

use Illuminate\Support\Carbon;


readonly class NudgeTypesDTO
{
    public function __construct(
        public Carbon $primer,
        public Carbon $trigger,
        public Carbon $consequence,
    ) {}

    public function copyWith(
        ?Carbon $primer = null,
        ?Carbon $trigger = null,
        ?Carbon $consequence = null,
    ): self {
        return new self(
            primer: $primer ?? $this->primer,
            trigger: $trigger ?? $this->trigger,
            consequence: $consequence ?? $this->consequence,
        );
    }
}
