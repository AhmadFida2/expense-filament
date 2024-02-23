<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomeResource\Pages;
use App\Filament\Resources\IncomeResource\RelationManagers;
use App\Models\Income;
use App\Models\IncomeSubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomeResource extends Resource
{
    protected static ?string $model = Income::class;

    protected static ?int $navigationSort = 1;


    protected static ?string $navigationGroup = 'Income';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('income_amount')->numeric()->required(),
                Forms\Components\DatePicker::make('income_date')->required()->default(now()),
                Forms\Components\Select::make('account_id')->label('Account')->relationship('account','account_number')->required(),
                Forms\Components\Select::make('income_category_id')->label('Category')->relationship('income_category','category_name')->required()->live(),
                Forms\Components\Select::make('income_sub_category_id')->label('Sub Category')->relationship('income_sub_category','sub_category_name')
                    ->reactive()->options(function ($get){
                        return IncomeSubCategory::query()->where('income_category_id',$get('income_category_id'))->pluck('sub_category_name','id');
                    }),
                Forms\Components\Textarea::make('income_note')->label('Note'),
                Forms\Components\Hidden::make('user_id')->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('income_date')->date('d M Y'),
            Tables\Columns\TextColumn::make('account.account_number'),
            Tables\Columns\TextColumn::make('income_category.category_name'),
            Tables\Columns\TextColumn::make('income_sub_category.sub_category_name'),
            Tables\Columns\TextColumn::make('income_amount')->money('PKR'),
            Tables\Columns\TextColumn::make('income_note')
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
            'index' => Pages\ListIncomes::route('/'),
            'create' => Pages\CreateIncome::route('/create'),
            'edit' => Pages\EditIncome::route('/{record}/edit'),
        ];
    }
}
