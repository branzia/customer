<?php

namespace Branzia\Customer\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Grid;
use Branzia\Customer\Models\Customer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Branzia\Bootstrap\Resource\ResourcePageExtensionManager;
use Branzia\Bootstrap\Resource\ResourceNavigationItemsManager;
use Branzia\Customer\Filament\Resources\CustomerResource\Pages;


class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationGroup = 'Customers';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        $baseSchema = [
            Section::make('Basic Information')->schema([
                Select::make('customer_group_id')->relationship(
                    name: 'group',
                    titleAttribute: 'code',
                    modifyQueryUsing: fn ($query) => $query->where('code', '!=', 'NOT LOGGED IN')
                )->label('Customer Group')->required(),
                Fieldset::make('Customer Name')->schema([                
                    TextInput::make('prefix')->label('Name Prefix')->maxLength(10)->placeholder('Mr, Ms, Dr')->columnSpan(1),
                    TextInput::make('first_name')->label('First Name')->required()->maxLength(255),
                    TextInput::make('last_name')->label('Last Name')->required()->maxLength(255),
                    TextInput::make('suffix')->label('Name Suffix')->maxLength(10)->placeholder('Jr, Sr')->columnSpan(1),
                ])->columns(4),
                TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                TextInput::make('tax')->label('Tax')->nullable(),
                DatePicker::make('date_of_birth')->label('Date of Birth')->nullable(),
                
                Select::make('gender')->label('Gender')->options(['male' => 'Male','female' => 'Female','not_specified' => 'Not Specified'])->nullable(),
            ]),
            Section::make('Password Information')->schema([
                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->revealable()
                    ->same('passwordConfirmation')
                    ->required(fn (string $context) => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state)), // ✅ This prevents null value from being saved
                TextInput::make('passwordConfirmation')
                    ->password()
                    ->label('Confirm Password')
                    ->required(fn (string $context) => $context === 'create')
                    ->dehydrated(false)
                    ->revealable(),
            ])->columns(2),

        ];
        return $form->schema(
            Form::withAdditionalField($baseSchema, static::class)
        );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('ID'),
                TextColumn::make('first_name')->label('First Name')->searchable()->sortable(),
                TextColumn::make('last_name')->label('Last Name')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable()->sortable(),
                BadgeColumn::make('group.code')->label('Customer Group')->colors([
                    'primary',
                    'warning' => fn ($state): bool => $state === 'NOT LOGGED IN',
                    'success' => fn ($state): bool => $state === 'Wholesale',
                ]),
                TextColumn::make('created_at')->label('Registered At')->dateTime('M d, Y'),            
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
           
        ];
    }
    public static function getRecordSubNavigation(Page $page): array
    {
        $navigationItems = ResourceNavigationItemsManager::apply([
            Pages\EditCustomer::class,
            Pages\CustomerAddress::class,
        ], static::class);
        return $page->generateNavigationItems($navigationItems);
    }    

    public static function getPages(): array
    {
        return ResourcePageExtensionManager::apply([
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
            'address' => Pages\CustomerAddress::route('/{record}/address'),
        ], static::class);
    }
}
