<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class CpfE extends CpfC
{
    public function __construct(
        string $name,
        \DateTimeImmutable $dayOfBirth,
        string $mothersName,
        Gender $gender,
        public RegistrationStatus $status,
    ) {
        parent::__construct($name, $dayOfBirth, $mothersName, $gender);
    }

    public static function fromArray(array $payload): self
    {
        $cpfC = parent::fromArray($payload);

        return new self(
            $cpfC->name,
            $cpfC->dayOfBirth,
            $cpfC->mothersName,
            $cpfC->gender,
            RegistrationStatus::from($payload['situacao']),
        );
    }
}
