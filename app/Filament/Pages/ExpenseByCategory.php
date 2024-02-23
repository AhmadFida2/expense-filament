<?php

namespace App\Filament\Pages;

use App\Models\Account;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class ExpenseByCategory extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.pages.expense-by-category';

    protected static ?string $navigationGroup = 'Reports';

    public ?array $input_data = [];

    public $expenses,$category,$account;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('account_number')->options(Account::pluck('account_number', 'id'))
                    ->required(),
                Select::make('expense_category')->options(ExpenseCategory::pluck('category_name', 'id'))
                    ->required(),
                DatePicker::make('month')->required()->default(now())->native(false)->format('Y-m-d')
                    ->displayFormat('M-Y'),
            ])
            ->statePath('input_data')
            ->columns(5);
    }

    public function create(): void
    {
        $account_id = $this->form->getState()['account_number'];
        $month = $this->form->getState()['month'];
        $date = Carbon::createFromFormat('Y-m-d', $month);
        $this->date = Carbon::createFromFormat('Y-m-d', $month);
        $this->account = Account::find($account_id)->account_number;
        $expenses = Expense::query()->where('expense_category_id',$this->form->getState()['expense_category'])
            ->where('expense_date', '<=', $date->endOfMonth()->format('Y-m-d'))
            ->where('expense_date', '>=', $date->startOfMonth()->format('Y-m-d'))->get();
        $this->expenses = $expenses;
    }





}
