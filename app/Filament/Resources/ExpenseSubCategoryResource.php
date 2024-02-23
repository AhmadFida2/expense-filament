<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseSubCategoryResource\Pages;
use App\Filament\Resources\ExpenseSubCategoryResource\RelationManagers;
use App\Models\ExpenseSubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseSubCategoryResource extends Resource
{
    protected static ?string $model = ExpenseSubCategory::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Expense';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sub_category_name')->required(),
                Forms\Components\Select::make('expense_category_id')->relationship('expense_category','category_name')->required(),
                Forms\Components\Hidden::make('user_id')->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sub_category_name'),
                Tables\Columns\TextColumn::make('expense_category.category_name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenseSubCategories::route('/'),
            'create' => Pages\CreateExpenseSubCategory::route('/create'),
            'edit' => Pages\EditExpenseSubCategory::route('/{record}/edit'),
        ];
    }
}
