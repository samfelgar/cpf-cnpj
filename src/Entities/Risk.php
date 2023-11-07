<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class Risk
{
    public function __construct(
        public RiskLevel $level,
        public string $description,
        public string $score,
    ) {
    }
}
