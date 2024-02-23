<?php

namespace App\Filament\Resources\AccountResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpensesRelationManager extends RelationManager
{
    protected static string $relationship = 'expenses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('expense_amount')->numeric()->required(),
                Forms\Components\DatePicker::make('expense_date')->required()->default(now()),
                Forms\Components\Select::make('expense_category_id')->relationship('expense_category','category_name')->required(),
                Forms\Components\Select::make('expense_sub_category_id')->relationship('expense_sub_category','sub_category_name')->required(),
                Forms\Components\Textarea::make('expense_note'),
                Forms\Components\Hidden::make('user_id')->default(auth()->id())
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('expense_date')
            ->columns([
                Tables\Columns\TextColumn::make('expense_date'),
                Tables\Columns\TextColumn::make('expense_amount'),
                Tables\Columns\TextColumn::make('expense_category.category_name'),
                Tables\Columns\TextColumn::make('expense_sub_category.sub_category_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
}
