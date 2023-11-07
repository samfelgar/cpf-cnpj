<?php

namespace Samfelgar\CpfCnpj\Tests\Entities;

use PHPUnit\Framework\Attributes\Test;
use Samfelgar\CpfCnpj\Entities\CpfB;
use PHPUnit\Framework\TestCase;

class CpfBTest extends TestCase
{
    #[Test]
    public function itCanBeCreated()
    {
        $this->assertInstanceOf(CpfB::class, new CpfB('John Doe', new \DateTimeImmutable()));
    }

    #[Test]
    public function itCanBeCreatedFromArray()
    {
        $payload = [
            'nome' => 'John Doe',
            'nascimento' => '01/01/2000',
        ];

        $this->assertInstanceOf(CpfB::class, CpfB::fromArray($payload));
    }
}
