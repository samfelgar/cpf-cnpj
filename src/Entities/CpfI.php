<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class CpfI extends CpfA
{
    /**
     * @param string[] $companies
     */
    public function __construct(
        string $name,
        public array $companies,
    ) {
        parent::__construct($name);
    }

    public static function fromArray(array $payload): self
    {
        $cpfA = parent::fromArray($payload);

        return new self(
            $cpfA->name,
            $payload['empresas'],
        );
    }
}
