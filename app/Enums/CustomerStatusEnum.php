<?php

namespace App\Enums;

enum CustomerStatusEnum: String
{
    case REGISTERED = 'registered';
    case NOT_REGISTERED = 'not_registered';
    case FROZEN = 'frozen';
    case STOPPED = 'stopped';

    public function label(): string
    {
        return match ($this) {
            self::REGISTERED    => __('customer.registered'),
            self::NOT_REGISTERED  => __('customer.not_registered'),
            self::FROZEN    => __('customer.frozen'),
            self::STOPPED  => __('customer.stopped'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::REGISTERED    => 'green',
            self::NOT_REGISTERED  => 'red',
            self::FROZEN    => 'blue',
            self::STOPPED  => 'gray',
        };
    }
}
