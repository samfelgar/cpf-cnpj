<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class Address
{
    public function __construct(
        public string $address,
        public string $number,
        public ?string $complement,
        public string $neighborhood,
        public string $zipCode,
        public string $city,
        public string $state,
    ) {
    }
}
