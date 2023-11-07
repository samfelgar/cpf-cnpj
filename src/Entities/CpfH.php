<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

readonly class CpfH extends CpfA
{
    public function __construct(
        string $name,
        public PepInfoCollection $pepInfoCollection,
    ) {
        parent::__construct($name);
    }

    public static function fromArray(array $payload): self
    {
        $cpfA = parent::fromArray($payload);

        $pepInfoCollection = new PepInfoCollection();

        foreach ($payload['ppe'] as $info) {
            $pepInfoCollection->attach(new PepInfo(
                $info['sigla'],
                $info['funcao'],
                $info['nivel'],
                $info['orgao'],
                isset($info['inicioexercicio']) ? \DateTimeImmutable::createFromFormat('d/m/Y', $info['inicioexercicio']) : null,
                isset($info['fimexercicio']) ? \DateTimeImmutable::createFromFormat('d/m/Y', $info['fimexercicio']) : null,
                isset($info['fimcarencia']) ? \DateTimeImmutable::createFromFormat('d/m/Y', $info['fimcarencia']) : null,
            ));
        }

        return new self(
            $cpfA->name,
            $pepInfoCollection
        );
    }
}
