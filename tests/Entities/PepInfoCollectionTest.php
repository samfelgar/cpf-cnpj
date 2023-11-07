<?php

namespace Samfelgar\CpfCnpj\Tests\Entities;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Samfelgar\CpfCnpj\Entities\PepInfo;
use Samfelgar\CpfCnpj\Entities\PepInfoCollection;

class PepInfoCollectionTest extends TestCase
{
    #[Test]
    public function itCanHoldPepInfoObjects(): void
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

        $this->assertEquals(1, $collection->count());
    }

    #[Test]
    public function itOnlyAcceptsPepInfoObjects(): void
    {
        $collection = new PepInfoCollection();
        $this->expectException(\InvalidArgumentException::class);
        $collection->attach(new \stdClass());
    }
}
