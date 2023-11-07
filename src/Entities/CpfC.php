<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class CpfC extends CpfB
{
    public function __construct(
        string $name,
        \DateTimeImmutable $dayOfBirth,
        public string $mothersName,
        public Gender $gender,
    ) {
        parent::__construct($name, $dayOfBirth);
    }

    public static function fromArray(array $payload): self
    {
        $cpfB = parent::fromArray($payload);

        return new self(
            $cpfB->name,
            $cpfB->dayOfBirth,
            $payload['mae'],
            Gender::from($payload['genero'])
        );
    }
}
