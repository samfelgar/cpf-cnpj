<?php

namespace Samfelgar\CpfCnpj\Tests\Entities;

use PHPUnit\Framework\Attributes\Test;
use Samfelgar\CpfCnpj\Entities\CpfA;
use PHPUnit\Framework\TestCase;

class CpfATest extends TestCase
{
    #[Test]
    public function itCanBeCreated(): void
    {
        $this->assertInstanceOf(CpfA::class, new CpfA('John Doe'));
    }

    #[Test]
    public function itCanBeCreatedFromArray(): void
    {
        $payload = [
            'nome' => 'John Doe',
        ];

        $this->assertInstanceOf(CpfA::class, CpfA::fromArray($payload));
    }
}
