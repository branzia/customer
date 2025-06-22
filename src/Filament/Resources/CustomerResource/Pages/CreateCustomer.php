<?php

namespace Branzia\Customer\Filament\Resources\CustomerResource\Pages;

use Branzia\Customer\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
