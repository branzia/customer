<?php

namespace Branzia\Customer\Filament\Resources\CustomerGroupResource\Pages;

use Branzia\Customer\Filament\Resources\CustomerGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerGroups extends ListRecords
{
    protected static string $resource = CustomerGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
