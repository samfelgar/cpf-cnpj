<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

/**
 * @template TObject of PepInfo
 * @template TValue
 */
class PepInfoCollection extends \SplObjectStorage
{
    public function attach(object $object, mixed $info = null): void
    {
        if (!$object instanceof PepInfo) {
            throw new \InvalidArgumentException('Object should be an instance of ' . PepInfo::class);
        }

        parent::attach($object, $info);
    }
}
