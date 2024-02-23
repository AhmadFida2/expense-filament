<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Expense;
use App\Models\ExpenseSubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?int $navigationSort = 1;


    protected static ?string $navigationGroup = 'Expense';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('expense_amount')->numeric()->required(),
                Forms\Components\DatePicker::make('expense_date')->required()->default(now()),
                Forms\Components\Select::make('account_id')->label('Account')->relationship('account','account_number')->required(),
                Forms\Components\Select::make('expense_category_id')->label('Category')->relationship('expense_category','category_name')->required()->live(),
                Forms\Components\Select::make('expense_sub_category_id')->label('Sub Category')->reactive()->options(function ($get){
                    return ExpenseSubCategory::query()->where('expense_category_id',$get('expense_category_id'))->pluck('sub_category_name','id');
                }),
                Forms\Components\Textarea::make('expense_note')->label('Note'),
                Forms\Components\Hidden::make('user_id')->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expense_date')->date('d M Y'),
                Tables\Columns\TextColumn::make('account.account_number'),
                Tables\Columns\TextColumn::make('expense_category.category_name'),
                Tables\Columns\TextColumn::make('expense_sub_category.sub_category_name'),
                Tables\Columns\TextColumn::make('expense_amount')->money('PKR'),
                Tables\Columns\TextColumn::make('expense_note')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
