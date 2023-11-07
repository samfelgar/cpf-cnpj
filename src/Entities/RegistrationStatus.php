<?php

namespace Samfelgar\CpfCnpj\Entities;

enum RegistrationStatus: string
{
    case Regular = 'Regular';
    case Cancelled = 'Cancelada';
    case Suspended = 'Suspended';
    case Pending = 'Pendente';
    case Null = 'Nula';
}
