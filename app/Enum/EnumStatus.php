<?php

namespace App\Enum;

final class EnumStatus
{
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const CANCELED = 'canceled';

    public static function getStatuses()
    {
        return [
            self::PENDING => 'Pendente',
            self::COMPLETED => 'Completa',
            self::CANCELED => 'Cancelada',
        ];
    }

    public static function getStatusName($status)
    {
        return self::getStatuses()[$status];
    }
}
