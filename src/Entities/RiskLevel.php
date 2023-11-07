<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Entities;

enum RiskLevel: int
{
    case Unknown = 0;
    case Low = 1;
    case Medium = 2;
    case High = 3;
    case Higher = 4;
}
