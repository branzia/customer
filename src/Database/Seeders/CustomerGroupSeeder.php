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
            ['code' => 'NOT LOGGED IN', 'tax_class_id' => '9'],
            ['code' => 'General', 'tax_class_id' => '9'],
            ['code' => 'Wholesale', 'tax_class_id' => '9'],
            ['code' => 'Retailer', 'tax_class_id' => '9'],
        ];
        foreach ($defaultClasses as $class) {
            CustomerGroup::firstOrCreate(
                ['code' => $class['code']],
                ['tax_class_id' => $class['tax_class_id']]
            );
        }
    }
}
