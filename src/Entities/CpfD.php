<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class CpfD extends CpfB
{
    public function __construct(
        string $name,
        \DateTimeImmutable $dayOfBirth,
        public RegistrationStatus $status,
    ) {
        parent::__construct($name, $dayOfBirth);
    }

    public static function fromArray(array $payload): self
    {
         $cpfB = parent::fromArray($payload);

         return new self(
             $cpfB->name,
             $cpfB->dayOfBirth,
             RegistrationStatus::from($payload['situacao'])
         );
    }
}
