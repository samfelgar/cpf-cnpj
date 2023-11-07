<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

enum Package: int
{
    case CpfA = 1;
    case CpfB = 7;
    case CpfC = 2;
    case CpfD = 8;
    case CpfE = 9;
    case CpfF = 3;
    case CpfG = 13;
    case CpfH = 14;
    case CpfI = 15;
    case CnpjA = 4;
    case CnpjB = 5;
    case CnpjC = 10;
    case CnpjD = 6;
    case CnpjF = 11;
    case CnpjG = 12;
    case CnpjH = 16;

    public function isCpfPackage(): bool
    {
        return in_array($this, [
            self::CpfA,
            self::CpfB,
            self::CpfC,
            self::CpfD,
            self::CpfE,
            self::CpfF,
            self::CpfG,
            self::CpfH,
            self::CpfI,
        ]);
    }

    public function isCnpjPackage(): bool
    {
        return in_array($this, [
            self::CnpjA,
            self::CnpjB,
            self::CnpjC,
            self::CnpjD,
            self::CnpjF,
            self::CnpjG,
            self::CnpjH,
        ]);
    }
}
