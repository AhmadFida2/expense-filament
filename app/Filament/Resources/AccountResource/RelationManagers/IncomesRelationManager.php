<?php

namespace App\Filament\Resources\AccountResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IncomesRelationManager extends RelationManager
{
    protected static string $relationship = 'incomes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('income_amount')->numeric()->required(),
                Forms\Components\DatePicker::make('income_date')->required()->default(now()),
                Forms\Components\Select::make('income_category_id')->relationship('income_category','category_name')->required()
                ->createOptionForm([
                    Forms\Components\TextInput::make('category_name')->required(),
                    Forms\Components\Hidden::make('user_id')->default(auth()->id())
                ]),
                Forms\Components\Select::make('income_sub_category_id')->relationship('income_sub_category','sub_category_name')->required()
                ->createOptionForm([
                    Forms\Components\TextInput::make('sub_category_name')->required(),
                    Forms\Components\Select::make('income_category_id')->relationship('income_category','category_name')->required(),
                    Forms\Components\Hidden::make('user_id')->default(auth()->id())
                ]),
                Forms\Components\Textarea::make('income_note'),
                Forms\Components\Hidden::make('user_id')->default(auth()->id())
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('income_date')
            ->columns([
                Tables\Columns\TextColumn::make('income_date'),
                Tables\Columns\TextColumn::make('income_amount'),
                Tables\Columns\TextColumn::make('income_category.category_name'),
                Tables\Columns\TextColumn::make('income_sub_category.sub_category_name'),
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
