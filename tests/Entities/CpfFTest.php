<?php

namespace Samfelgar\CpfCnpj\Tests\Entities;

use Faker\Factory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Samfelgar\CpfCnpj\Entities\Address;
use Samfelgar\CpfCnpj\Entities\CpfF;

class CpfFTest extends TestCase
{
    #[Test]
    public function itCanBeCreated()
    {
        $faker = Factory::create('pt_BR');

        $cpf = new CpfF(
            'John Doe',
            new \DateTimeImmutable(),
            new Address(
                $faker->address(),
                $faker->numerify(),
                null,
                $faker->secondaryAddress(),
                $faker->postcode(),
                $faker->city(),
                $faker->stateAbbr(),
            )
        );

        $this->assertInstanceOf(CpfF::class, $cpf);
    }

    #[Test]
    public function itCanBeCreatedFromArray()
    {
        $faker = Factory::create('pt_BR');

        $payload = [
            'nome' => 'John Doe',
            'nascimento' => '01/01/2000',
            'endereco' => $faker->address(),
            'numero' => $faker->numerify(),
            'complemento' => null,
            'bairro' => $faker->secondaryAddress(),
            'cep' => $faker->postcode(),
            'cidade' => $faker->city(),
            'uf' => $faker->stateAbbr(),
        ];

        $this->assertInstanceOf(CpfF::class, CpfF::fromArray($payload));
    }
}
