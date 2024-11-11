<?php

namespace App\Enum;

final class EnumStatus
{
    const PENDING = 'pending';
    const COMPLETED = 'completed';

    public static function getStatuses()
    {
        return [
            self::PENDING => 'Pendente',
            self::COMPLETED => 'Completa',
        ];
    }

    public static function getStatusName($status)
    {
        return self::getStatuses()[$status];
    }
}
