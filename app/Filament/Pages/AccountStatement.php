<?php

namespace App\Filament\Pages;

use App\Models\Account;
use App\Models\Expense;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;
use Faker\Provider\Text;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

class AccountStatement extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.pages.account-statement';

    protected static ?string $navigationGroup = 'Reports';

    public ?array $input_data = [];

    public $expenses,$incomes,$account;

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
        $this->account_id = $account_id;
        $this->account = Account::find($account_id)->account_number;
        $account = Account::query()->with(['expenses','incomes'])
            ->whereRelation('expenses', 'expense_date', '<=', $date->endOfMonth()->format('Y-m-d'))
            ->whereRelation('expenses', 'expense_date', '>=', $date->startOfMonth()->format('Y-m-d'))
            ->whereRelation('incomes', 'income_date', '<=', $date->endOfMonth()->format('Y-m-d'))
            ->whereRelation('incomes', 'income_date', '>=', $date->startOfMonth()->format('Y-m-d'))
            ->where('id', $account_id)->first();
        $this->incomes = $account->incomes;
        $this->expenses = $account->expenses;
    }

}
