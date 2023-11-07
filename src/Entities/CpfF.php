<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class CpfF extends CpfB
{
    public function __construct(
        string $name,
        \DateTimeImmutable $dayOfBirth,
        public Address $address,
    ) {
        parent::__construct($name, $dayOfBirth);
    }

    public static function fromArray(array $payload): CpfB
    {
        $cpfB = parent::fromArray($payload);

        return new self(
            $cpfB->name,
            $cpfB->dayOfBirth,
            new Address(
                $payload['endereco'],
                $payload['numero'],
                $payload['complemento'],
                $payload['bairro'],
                $payload['cep'],
                $payload['cidade'],
                $payload['uf'],
            )
        );
    }
}
