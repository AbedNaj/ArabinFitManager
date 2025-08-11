<?php

namespace App\Enums;

enum RegistrationStatusEnum: string
{
    case WAITING  = 'waiting';
    case ACTIVE   = 'active';
    case EXPIRED  = 'expired';
    case FREEZED  = 'freezed';
    case STOPPED  = 'stopped';

    public function label(): string
    {
        return match ($this) {
            self::WAITING  => __('registration.status_waiting'),
            self::ACTIVE   => __('registration.status_active'),
            self::EXPIRED  => __('registration.status_expired'),
            self::FREEZED  => __('registration.status_freezed'),
            self::STOPPED  => __('registration.status_stopped'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::WAITING  => 'gray',
            self::ACTIVE   => 'green',
            self::EXPIRED  => 'red',
            self::FREEZED  => 'yellow',
            self::STOPPED  => 'slate',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::WAITING  => 'clock',
            self::ACTIVE   => 'check-circle',
            self::EXPIRED  => 'x-circle',
            self::FREEZED  => 'pause-circle',
            self::STOPPED  => 'ban',
        };
    }
}
