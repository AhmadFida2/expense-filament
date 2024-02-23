<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Filament\Resources\AccountResource\RelationManagers;
use App\Models\Account;
use App\Models\Expense;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationGroup = 'Accounts';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('account_number')->required(),
                Select::make('account_type')->options(['Cash'=> 'Cash', 'Bank' => 'Bank', 'Credit Card' => 'Credit Card'])->required(),
                TextInput::make('opening_balance')->numeric()->required()->default(0),
                Hidden::make('user_id')->default(auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('account_number'),
                Tables\Columns\TextColumn::make('account_type')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Cash' => 'success',
                        'Bank' => 'primary',
                        'Credit Card' => 'warning'
                    }),
                Tables\Columns\TextColumn::make('opening_balance')->money('PKR'),
                Tables\Columns\TextColumn::make('running_balance')->money('PKR')->state(fn($record)=>$record->running_balance())
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ExpensesRelationManager::class,
            RelationManagers\IncomesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
