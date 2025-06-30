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
use Branzia\Bootstrap\Table\TableExtensionManager;
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
        $baseSchema = [
            Section::make('Group Information')->schema([
            Forms\Components\TextInput::make('code')->label('Group Name')->required()->maxLength(255),
            ]) 
        ];
        return $form->schema(
            Form::withAdditionalField($baseSchema, static::class)
        );    
    }

    public static function table(Table $table): Table
    {
        
        return $table
            ->columns(TableExtensionManager::apply([
                Tables\Columns\TextColumn::make('code')->label('Group Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Created'),
            ], static::class))
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
