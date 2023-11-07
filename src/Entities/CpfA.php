<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class CpfA
{
    public function __construct(
        public string $name,
    ) {
    }

    public static function fromArray(array $payload): self
    {
        return new self($payload['nome']);
    }
}
