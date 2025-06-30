<?php

namespace Branzia\Customer\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Branzia\Customer\Models\CustomerGroup;
class CustomerGroupSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $defaultClasses = [
            ['code' => 'NOT LOGGED IN'],
            ['code' => 'General'],
            ['code' => 'Wholesale'],
            ['code' => 'Retailer'],
        ];
        foreach ($defaultClasses as $class) {
            CustomerGroup::firstOrCreate(
                ['code' => $class['code']],
            );
        }
    }
}
