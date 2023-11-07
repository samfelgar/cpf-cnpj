<?php

namespace Samfelgar\CpfCnpj\Tests\Entities;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Samfelgar\CpfCnpj\Entities\CpfH;
use Samfelgar\CpfCnpj\Entities\PepInfo;
use Samfelgar\CpfCnpj\Entities\PepInfoCollection;

class CpfHTest extends TestCase
{
    #[Test]
    public function itCanBeCreated()
    {
        $collection = new PepInfoCollection();
        $collection->attach(new PepInfo(
            'SP', // Super party
            'president',
            null,
            'Federal Government',
            new \DateTimeImmutable(),
            null,
            null
        ));

        $cpf = new CpfH(
            'John Doe',
            $collection
        );

        $this->assertInstanceOf(CpfH::class, $cpf);
    }

    #[Test]
    public function itCanBeCreatedFromArray()
    {
        $payload = [
            'nome' => 'John Doe',
            'ppe' => [
                [
                    'sigla' => 'SP',
                    'funcao' => 'president',
                    'nivel' => null,
                    'orgao' => 'Fed',
                    'inicioexercicio' => '01/01/2000',
                    'fimexercicio' => null,
                    'fimcarencia' => null,
                ],
                [
                    'sigla' => 'SP',
                    'funcao' => 'president',
                    'nivel' => 'top',
                    'orgao' => 'Fed',
                    'inicioexercicio' => '01/01/2000',
                    'fimexercicio' => '01/01/2010',
                    'fimcarencia' => '01/01/2001',
                ],
            ],
        ];

        $this->assertInstanceOf(CpfH::class, CpfH::fromArray($payload));
    }
}
