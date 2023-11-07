<?php

namespace Samfelgar\CpfCnpj\Tests\Entities;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Samfelgar\CpfCnpj\Entities\CpfD;
use Samfelgar\CpfCnpj\Entities\CpfE;
use PHPUnit\Framework\TestCase;
use Samfelgar\CpfCnpj\Entities\Gender;
use Samfelgar\CpfCnpj\Entities\RegistrationStatus;

class CpfETest extends TestCase
{
    #[Test]
    public function itCanBeCreated()
    {
        $cpf = new CpfE(
            'John Doe',
            new \DateTimeImmutable(),
            'Mary Doe',
            Gender::Male,
            RegistrationStatus::Regular
        );

        $this->assertInstanceOf(CpfE::class, $cpf);
    }

    #[Test]
    #[DataProvider('registrationStatus')]
    public function itCanBeCreatedFromArray(string $status)
    {
        $payload = [
            'nome' => 'John Doe',
            'nascimento' => '01/01/2000',
            'situacao' => $status,
            'mae' => 'Jane Doe',
            'genero' => 'M',
        ];

        $this->assertInstanceOf(CpfD::class, CpfD::fromArray($payload));
    }

    public static function registrationStatus(): array
    {
        return [
            [RegistrationStatus::Pending->value],
            [RegistrationStatus::Cancelled->value],
            [RegistrationStatus::Null->value],
            [RegistrationStatus::Regular->value],
            [RegistrationStatus::Suspended->value],
        ];
    }
}
