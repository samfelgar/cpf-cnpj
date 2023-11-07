<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class CpfG extends CpfA
{
    public function __construct(
        string $name,
        public Risk $risk,
    ) {
        parent::__construct($name);
    }

    public static function fromArray(array $payload): self
    {
        $cpfA = parent::fromArray($payload);

        return new self(
            $cpfA->name,
            new Risk(
                RiskLevel::from($payload['risco']['nivel']),
                $payload['risco']['descricao'],
                $payload['risco']['score'],
            ),
        );
    }
}
