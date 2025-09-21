<?php

namespace App\Enums\SuperAdmin;

enum Permissions: string
{
    // features
    case CUSTOMERS = 'customers';
    case REGISTRATIONS = 'registrations';
    case PLANS = 'plans';
    case DEBTS = 'debts';
    case STATISTICS = 'statistics';

    public function name(): string
    {
        return match ($this) {
            self::CUSTOMERS => 'Customers',
            self::REGISTRATIONS => 'Registrations',
            self::PLANS => 'Plans',
            self::DEBTS => 'Debts',
            self::STATISTICS => 'Statistics',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::CUSTOMERS => 'Access to customer management features',
            self::REGISTRATIONS => 'Access to registration features',
            self::PLANS => 'Access to plans features',
            self::DEBTS => 'Access to debts features',
            self::STATISTICS => 'Access to statistics',
        };
    }

    /**
     * Return array of permission definitions.
     *
     * Each permission can be a string or an array with keys:
     *  - name (string)
     *  - description? (string|null)
     *  - sort? (int)
     *
     * @return array<int, string|array{ name: string, description?: ?string, sort?: int }>
     */
    public function permissions(): array
    {
        return match ($this) {
            self::CUSTOMERS => [
                ['name' => 'customers.view', 'description' => 'View customers', 'sort' => 10],
                ['name' => 'customers.create', 'description' => 'Create customers', 'sort' => 20],
                ['name' => 'customers.edit', 'description' => 'Edit customers', 'sort' => 30],
                ['name' => 'customers.delete', 'description' => 'Delete customers', 'sort' => 40],
            ],
            self::REGISTRATIONS => [
                ['name' => 'registrations.view', 'description' => 'View registrations', 'sort' => 10],
                ['name' => 'registrations.create', 'description' => 'Create registration', 'sort' => 20],
                ['name' => 'registrations.freeze', 'description' => 'Freeze registration', 'sort' => 30],
                ['name' => 'registrations.delete', 'description' => 'Delete registration', 'sort' => 40],
            ],
            self::PLANS => [
                ['name' => 'plans.view', 'description' => 'View plans', 'sort' => 10],
                ['name' => 'plans.create', 'description' => 'Create plans', 'sort' => 20],
                ['name' => 'plans.edit', 'description' => 'Edit plans', 'sort' => 30],
                ['name' => 'plans.delete', 'Delete plans', 'description' => 'Delete Plans', 'sort' => 40],
            ],
            self::DEBTS => [
                ['name' => 'debts.view', 'description' => 'View debts', 'sort' => 10],
                ['name' => 'debts.create', 'description' => 'Create debts', 'sort' => 20],
                ['name' => 'debts.edit', 'description' => 'Edit debts', 'sort' => 30],
                ['name' => 'debts.delete', 'Delete debts', 'description' => 'Delete debts', 'sort' => 40],
            ],
            self::STATISTICS => [
                ['name' => 'statistics.registrations', 'description' => 'View registration statistics', 'sort' => 10],
                ['name' => 'statistics.debts', 'description' => 'View debts statistics', 'sort' => 20],
                ['name' => 'statistics.income', 'description' => 'View income statistics', 'sort' => 30],

            ],
        };
    }
}
