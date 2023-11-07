<?php

namespace Samfelgar\CpfCnpj\Tests;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Samfelgar\CpfCnpj\CpfCnpj;
use Samfelgar\CpfCnpj\Entities\CpfA;
use Samfelgar\CpfCnpj\Entities\CpfB;
use Samfelgar\CpfCnpj\Entities\CpfC;
use Samfelgar\CpfCnpj\Entities\CpfD;
use Samfelgar\CpfCnpj\Entities\CpfE;
use Samfelgar\CpfCnpj\Entities\CpfF;
use Samfelgar\CpfCnpj\Entities\CpfG;
use Samfelgar\CpfCnpj\Entities\CpfH;
use Samfelgar\CpfCnpj\Entities\CpfI;
use Samfelgar\CpfCnpj\Entities\Package;
use Samfelgar\CpfCnpj\Exceptions\CpfCnpjException;

class CpfCnpjTest extends TestCase
{
    private const TOKEN = '5ae973d7a997af13f0aaf2bf60e65803';

    private static function getFaker(): Generator
    {
        return Factory::create('pt_BR');
    }

    #[Test]
    #[DataProvider('packageAndExpectedReturn')]
    public function itCanGetCpfInfo(Package $package, string $expected, array $response): void
    {
        $client = $this->clientStub($response);
        $requestFactory = $this->createStub(RequestFactoryInterface::class);
        $sut = new CpfCnpj($client, $requestFactory, self::TOKEN);

        $response = $sut->cpfRequest(self::getFaker()->cpf(), $package);

        $this->assertInstanceOf($expected, $response);
    }

    #[Test]
    public function itCannotGetCpfInfoWithCnpjPackage(): void
    {
        $client = $this->clientStub([]);
        $requestFactory = $this->createStub(RequestFactoryInterface::class);
        $sut = new CpfCnpj($client, $requestFactory, self::TOKEN);

        $this->expectException(\InvalidArgumentException::class);
        $sut->cpfRequest(self::getFaker()->cpf(), Package::CnpjA);
    }

    #[Test]
    public function itCannotGetCpfInfoWithInvalidCpfLength(): void
    {
        $client = $this->clientStub([]);
        $requestFactory = $this->createStub(RequestFactoryInterface::class);
        $sut = new CpfCnpj($client, $requestFactory, self::TOKEN);

        $this->expectException(\InvalidArgumentException::class);
        $sut->cpfRequest('12345', Package::CpfI);
    }

    #[Test]
    public function itThrowsAnExceptionIfReturnedStatusIsZero(): void
    {
        $client = $this->clientStub([
            'status' => 0,
            'erro' => 'Test',
            'erroCodigo' => 100,
        ]);
        $requestFactory = $this->createStub(RequestFactoryInterface::class);
        $sut = new CpfCnpj($client, $requestFactory, self::TOKEN);

        $this->expectException(CpfCnpjException::class);
        $this->expectExceptionCode(100);
        $this->expectExceptionMessage('Test');
        $sut->cpfRequest(self::getFaker()->cpf(), Package::CpfI);
    }

    private function clientStub(array $response): ClientInterface
    {
        $stream = $this->createStub(StreamInterface::class);
        $stream->method('__toString')->willReturn(json_encode($response));

        $response = $this->createStub(ResponseInterface::class);
        $response->method('getBody')->willReturn($stream);

        $client = $this->createStub(ClientInterface::class);
        $client->method('sendRequest')->willReturn($response);

        return $client;
    }

    public static function packageAndExpectedReturn(): array
    {
        return [
            [Package::CpfA, CpfA::class, self::cpfAResponse()],
            [Package::CpfB, CpfB::class, self::cpfBResponse()],
            [Package::CpfC, CpfC::class, self::cpfCResponse()],
            [Package::CpfD, CpfD::class, self::cpfDResponse()],
            [Package::CpfE, CpfE::class, self::cpfEResponse()],
            [Package::CpfF, CpfF::class, self::cpfFResponse()],
            [Package::CpfG, CpfG::class, self::cpfGResponse()],
            [Package::CpfH, CpfH::class, self::cpfHResponse()],
            [Package::CpfI, CpfI::class, self::cpfIResponse()],
        ];
    }

    private static function cpfAResponse(): array
    {
        return [
            'status' => 1,
            'nome' => 'John Doe',
        ];
    }

    private static function cpfBResponse(): array
    {
        return [
            'status' => 1,
            'nome' => 'John Doe',
            'nascimento' => '01/01/2000',
        ];
    }

    private static function cpfCResponse(): array
    {
        return [
            'status' => 1,
            'nome' => 'John Doe',
            'nascimento' => '01/01/2000',
            'mae' => 'Mary Doe',
            'genero' => 'M',
        ];
    }

    private static function cpfDResponse(): array
    {
        return [
            'status' => 1,
            'nome' => 'John Doe',
            'nascimento' => '01/01/2000',
            'situacao' => 'Regular',
        ];
    }

    private static function cpfEResponse(): array
    {
        return [
            'status' => 1,
            'nome' => 'John Doe',
            'nascimento' => '01/01/2000',
            'situacao' => 'Regular',
            'mae' => 'Jane Doe',
            'genero' => 'M',
        ];
    }

    private static function cpfFResponse(): array
    {
        $faker = self::getFaker();

        return [
            'status' => 1,
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
    }

    private static function cpfGResponse(): array
    {
        return [
            'status' => 1,
            'nome' => 'John Doe',
            'risco' => [
                'nivel' => 2,
                'descricao' => 'medium',
                'score' => '400-600'
            ]
        ];
    }

    private static function cpfHResponse(): array
    {
        return [
            'status' => 1,
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
    }

    private static function cpfIResponse(): array
    {
        $faker = self::getFaker();

        return [
            'status' => 1,
            'nome' => 'John Doe',
            'empresas' => [
                $faker->cnpj(),
                $faker->cnpj(),
                $faker->cnpj(),
                $faker->cnpj(),
                $faker->cnpj(),
            ],
        ];
    }
}
