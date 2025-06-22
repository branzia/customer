<?php

namespace Branzia\Customer\Filament\Resources\CustomerGroupResource\Pages;

use Branzia\Customer\Filament\Resources\CustomerGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerGroup extends EditRecord
{
    protected static string $resource = CustomerGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
