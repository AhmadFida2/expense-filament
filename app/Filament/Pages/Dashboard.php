<?php

namespace App\Filament\Pages;

use App\Models\Account;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseSubCategory;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\IncomeSubCategory;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class Dashboard extends \Filament\Pages\Dashboard
{

    public function getHeaderActions(): array
    {
        return [
            Action::make('create Account')
                ->form([
                    Grid::make(2)->schema([
                        TextInput::make('account_number')->required(),
                        Select::make('account_type')->options(['Cash'=> 'Cash', 'Bank' => 'Bank'])->required(),
                        TextInput::make('opening_balance')->numeric()->required()->default(0),
                        Hidden::make('user_id')->default(auth()->id()),
                    ]),
                ])
                ->action(function (array $data): void {
                    $record = new Account();
                    $record->fill($data);
                    $record->save();
                    $this->redirect('/dashboard');
                })->keyBindings('ctrl+a'),
            Action::make('create_expense')
                ->form([
                    Grid::make(2)->schema([
                        TextInput::make('expense_amount')->numeric()->required(),
                        DatePicker::make('expense_date')->required()->default(now()),
                        Select::make('account_id')->label('Account')->options(Account::pluck('account_number','id'))->required(),
                        Select::make('expense_category_id')->label('Category')->options(ExpenseCategory::pluck('category_name','id'))->required()->live(),
                        Select::make('expense_sub_category_id')->label('Sub Category')->reactive()->options(function ($get){
                            return ExpenseSubCategory::query()->where('expense_category_id',$get('expense_category_id'))->pluck('sub_category_name','id');
                        }),
                    ]),
                    Textarea::make('expense_note')->label('Note'),
                    Hidden::make('user_id')->default(auth()->id())
                ])
                ->action(function (array $data): void {
                    $record = new Expense();
                    $record->fill($data);
                    $record->save();
                    $this->redirect('/dashboard');
                })->keyBindings('ctrl+e'),
            Action::make('create_income')
                ->form([
                    Grid::make(2)->schema([
                        TextInput::make('income_amount')->numeric()->required(),
                        DatePicker::make('income_date')->required()->default(now()),
                        Select::make('account_id')->label('Account')->options(Account::pluck('account_number','id'))->required(),
                        Select::make('income_category_id')->label('Category')->options(IncomeCategory::pluck('category_name','id'))->required()->live(),
                        Select::make('income_sub_category_id')->label('Sub Category')
                            ->reactive()->options(function ($get){
                                return IncomeSubCategory::query()->where('income_category_id',$get('income_category_id'))->pluck('sub_category_name','id');
                            }),
                    ]),
                    Textarea::make('income_note')->label('Note'),
                    Hidden::make('user_id')->default(auth()->id())
                ])->action(function (array $data): void {
                    $record = new Income();
                    $record->fill($data);
                    $record->save();
                    $this->redirect('/dashboard');
                })->keyBindings('ctrl+i'),
        ];
    }

}
