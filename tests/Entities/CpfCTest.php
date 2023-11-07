<?php

namespace Samfelgar\CpfCnpj\Tests\Entities;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Samfelgar\CpfCnpj\Entities\CpfC;
use Samfelgar\CpfCnpj\Entities\Gender;

class CpfCTest extends TestCase
{
    #[Test]
    public function itCanBeCreated()
    {
        $cpf = new CpfC(
            'John Doe',
            new \DateTimeImmutable(),
            'Mary Doe',
            Gender::Male
        );

        $this->assertInstanceOf(CpfC::class, $cpf);
    }

    #[Test]
    public function itCanBeCreatedFromArray()
    {
        $payload = [
            'nome' => 'John Doe',
            'nascimento' => '01/01/2000',
            'mae' => 'Mary Doe',
            'genero' => 'M',
        ];

        $this->assertInstanceOf(CpfC::class, CpfC::fromArray($payload));
    }
}
