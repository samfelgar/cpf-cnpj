<?php

declare(strict_types=1);

namespace Samfelgar\CpfCnpj\Exceptions;

class CpfCnpjException extends \Exception
{
    public static function instance(int $code, string $message): self
    {
        return new self($message, $code);
    }
}
