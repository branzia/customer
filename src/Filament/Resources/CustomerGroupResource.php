<?php

namespace Branzia\Customer\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Branzia\Customer\Models\CustomerGroup;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Branzia\Customer\Filament\Resources\CustomerGroupResource\Pages;
use Branzia\Customer\Filament\Resources\CustomerGroupResource\RelationManagers;

class CustomerGroupResource extends Resource
{
    protected static ?string $model = CustomerGroup::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Customers';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Group Information')->schema([
                Forms\Components\TextInput::make('code')->label('Group Name')->required()->maxLength(255),
                Forms\Components\Select::make('tax_class_id')->relationship(
                    name: 'taxClass',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn ($query) => $query->where('type', 'customer')
                )->label('Customer Group')->required()->label('Tax Class')->preload()->nullable(),
               ]) 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Group Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('taxClass.name')->label('Tax Class')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerGroups::route('/'),
            'create' => Pages\CreateCustomerGroup::route('/create'),
            'edit' => Pages\EditCustomerGroup::route('/{record}/edit'),
        ];
    }
}
