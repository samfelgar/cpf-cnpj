<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
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

class CpfCnpj
{
    private const BASE_URI = 'https://api.cpfcnpj.com.br/';

    public function __construct(
        private readonly ClientInterface $client,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly string $token,
    ) {
    }

    private function prepareUrl(string $endpoint): string
    {
        return sprintf('%s/%s', self::BASE_URI, ltrim($endpoint, '/'));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws CpfCnpjException
     */
    public function cpfRequest(string $cpf, Package $package): CpfA
    {
        if (!$package->isCpfPackage()) {
            throw new \InvalidArgumentException('The package should be related to CPF');
        }

        $normalizedCpf = preg_replace('/\D/', '', $cpf);

        if (strlen($normalizedCpf) !== 11) {
            throw new \InvalidArgumentException('Invalid CPF length');
        }

        $request = $this->requestFactory->createRequest(
            'GET',
            $this->prepareUrl("{$this->token}/{$package->value}/$normalizedCpf")
        );

        $response = $this->client->sendRequest($request);
        $parsedBody = json_decode((string) $response->getBody(), true);

        if ($parsedBody['status'] === 0) {
            throw CpfCnpjException::instance($parsedBody['erroCodigo'], $parsedBody['erro']);
        }

        $method = match ($package) {
            Package::CpfA => CpfA::fromArray(...),
            Package::CpfB => CpfB::fromArray(...),
            Package::CpfC => CpfC::fromArray(...),
            Package::CpfD => CpfD::fromArray(...),
            Package::CpfE => CpfE::fromArray(...),
            Package::CpfF => CpfF::fromArray(...),
            Package::CpfG => CpfG::fromArray(...),
            Package::CpfH => CpfH::fromArray(...),
            Package::CpfI => CpfI::fromArray(...),
            default => throw new \InvalidArgumentException('Invalid package type'),
        };

        return $method($parsedBody);
    }
}
