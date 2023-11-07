<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class PepInfo
{
    public function __construct(
        public string $abbr,
        public string $position,
        public ?string $level,
        public string $institution,
        public \DateTimeImmutable $actingStart,
        public ?\DateTimeImmutable $actingEnd,
        public ?\DateTimeImmutable $endOfGracePeriod,
    ) {
    }
}
