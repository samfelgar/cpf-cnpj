<?php

namespace Samfelgar\CpfCnpj\Tests\Entities;

use Faker\Factory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Samfelgar\CpfCnpj\Entities\CpfI;

class CpfITest extends TestCase
{
    #[Test]
    public function itCanBeCreated()
    {
        $faker = Factory::create('pt_BR');

        $cpf = new CpfI(
            'John Doe',
            [
                $faker->cnpj(),
                $faker->cnpj(),
                $faker->cnpj(),
                $faker->cnpj(),
                $faker->cnpj(),
            ]
        );

        $this->assertInstanceOf(CpfI::class, $cpf);
    }

    #[Test]
    public function itCanBeCreatedFromArray()
    {
        $faker = Factory::create('pt_BR');

        $payload = [
            'nome' => 'John Doe',
            'empresas' => [
                $faker->cnpj(),
                $faker->cnpj(),
                $faker->cnpj(),
                $faker->cnpj(),
                $faker->cnpj(),
            ],
        ];

        $this->assertInstanceOf(CpfI::class, CpfI::fromArray($payload));
    }
}
