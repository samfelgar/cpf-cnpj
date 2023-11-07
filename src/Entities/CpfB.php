<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class CpfB extends CpfA
{
    public function __construct(
        string $name,
        public \DateTimeImmutable $dayOfBirth
    ) {
        parent::__construct($name);
    }

    public static function fromArray(array $payload): self
    {
        $cpfA = parent::fromArray($payload);
        $dayOfBirth = \DateTimeImmutable::createFromFormat('d/m/Y', $payload['nascimento']);
        return new self($cpfA->name, $dayOfBirth);
    }
}
