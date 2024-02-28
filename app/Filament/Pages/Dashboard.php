<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ExpenseResource;
use App\Filament\Resources\IncomeResource;
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
                        Select::make('account_type')->options(['Cash' => 'Cash', 'Bank' => 'Bank'])->required(),
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
                ->url(ExpenseResource::getUrl('create'))->keyBindings('ctrl+e'),
            Action::make('create_income')
                ->url(IncomeResource::getUrl('create'))->keyBindings('ctrl+i'),
        ];
    }

}
