<?php

namespace App\Enums;

enum RegistrationPaymentStatusEnum: string
{
    case UNPAID = 'unpaid';
    case PARTIAL = 'partial';
    case PAID = 'paid';

    public function label(): string
    {
        return match ($this) {
            self::UNPAID   => __('debt.status_unpaid'),
            self::PARTIAL  => __('debt.status_partial'),
            self::PAID     => __('debt.status_paid'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::UNPAID   => 'red',
            self::PARTIAL  => 'yellow',
            self::PAID     => 'green',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::UNPAID   => 'x-circle',
            self::PARTIAL  => 'minus-circle',
            self::PAID     => 'check-circle',
        };
    }
}
