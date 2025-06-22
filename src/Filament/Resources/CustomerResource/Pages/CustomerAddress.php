<?php

namespace Branzia\Customer\Filament\Resources\CustomerResource\Pages;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ManageRelatedRecords;
use Branzia\Customer\Filament\Resources\CustomerResource;

class CustomerAddress extends ManageRelatedRecords
{
    protected static string $resource = CustomerResource::class;

    protected static string $relationship = 'addresses';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function getTitle(): string | Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return "Manage {$recordTitle} Customer address";
    }

    public function getBreadcrumb(): string
    {
        return 'Address';
    }


    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Address')->schema([    
                TextInput::make('first_name')->required(),
                TextInput::make('last_name')->required(),
                TextInput::make('company')->nullable(),
                TextInput::make('telephone')->required(),
                Toggle::make('is_default')->label('Default for this type')->default(false),
                Select::make('type')->options(['billing' => 'Billing','shipping' => 'Shipping'])->default('billing')->required(),
            ]),
            Forms\Components\Section::make('Address')->schema([
                Forms\Components\TextInput::make('street_address_1')->label('Street Address 1')->required(),
                Forms\Components\TextInput::make('street_address_2')->nullable(),
                Forms\Components\TextInput::make('city')->required(),
                Forms\Components\TextInput::make('zip_code')->required(),
                Forms\Components\TextInput::make('state')->label('State')->required(),                            
                Forms\Components\Select::make('country_id')->label('Country')->options(Countries::all()->pluck('name', 'id'))->reactive()->afterStateUpdated(fn ($state, callable $set) => $set('state', null))->required(),
            ])->columns(2),
        ])->columns(2);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(1)
            ->schema([
                TextEntry::make('first_name'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('type')->sortable(),
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('city'),
                TextColumn::make('country_code'),
                ToggleColumn::make('is_default'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
