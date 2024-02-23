<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeCategoryResource\Pages;
use App\Filament\Resources\IncomeCategoryResource\RelationManagers;
use App\Models\IncomeCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeCategoryResource extends Resource
{
    protected static ?string $model = IncomeCategory::class;

    protected static ?int $navigationSort = 2;


    protected static ?string $navigationGroup = 'Income';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('category_name')->required(),
                Forms\Components\Hidden::make('user_id')->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category_name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListIncomeCategories::route('/'),
            'create' => Pages\CreateIncomeCategory::route('/create'),
            'edit' => Pages\EditIncomeCategory::route('/{record}/edit'),
        ];
    }
}
