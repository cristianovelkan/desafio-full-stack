<?php

namespace App\Enum;

final class EnumType
{
    const IN = 'in';
    const OUT = 'out';

    public static function getTypes()
    {
        return [
            self::IN => 'Entrada',
            self::OUT => 'Saída',
        ];
    }

    public static function getTypeName($status)
    {
        return self::getTypes()[$status];
    }
}
