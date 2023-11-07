<?php

namespace Samfelgar\CpfCnpj\Tests\Entities;

use PHPUnit\Framework\Attributes\Test;
use Samfelgar\CpfCnpj\Entities\CpfG;
use PHPUnit\Framework\TestCase;
use Samfelgar\CpfCnpj\Entities\Gender;
use Samfelgar\CpfCnpj\Entities\Risk;
use Samfelgar\CpfCnpj\Entities\RiskLevel;

class CpfGTest extends TestCase
{
    #[Test]
    public function itCanBeCreated()
    {
        $cpf = new CpfG(
            'John Doe',
            new Risk(
                RiskLevel::Medium,
                'medium',
                '400-600'
            ),
        );

        $this->assertInstanceOf(CpfG::class, $cpf);
    }

    #[Test]
    public function itCanBeCreatedFromArray()
    {
        $payload = [
            'nome' => 'John Doe',
            'risco' => [
                'nivel' => 2,
                'descricao' => 'medium',
                'score' => '400-600'
            ]
        ];

        $this->assertInstanceOf(CpfG::class, CpfG::fromArray($payload));
    }
}
