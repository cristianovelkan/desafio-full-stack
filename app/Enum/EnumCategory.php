<?php

namespace App\Enum;

final class EnumCategory
{
    const DEPOSIT = 'deposit';
    const TRANSFER = 'transfer';

    public static function getCategories()
    {
        return [
            self::DEPOSIT => 'Depósito',
            self::TRANSFER => 'Transferência',
        ];
    }

    public static function getCategoryName($status)
    {
        return self::getCategories()[$status];
    }
}
