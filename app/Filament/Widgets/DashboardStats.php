<?php

namespace App\Filament\Widgets;

use App\Models\Account;
use App\Models\Expense;
use App\Models\Income;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use function Filament\Support\format_money;

class DashboardStats extends BaseWidget
{
    protected $max_expense_category = 'Income Summary';
    protected $max_expense_amount = 0;

    protected function set_max_cat_amt()
    {
        $data = Expense::query()->groupBy('expense_category_id')->selectRaw('sum(expense_amount) as amount,expense_category_id')->with('expense_category')->orderBy('amount','DESC')->first();
        $this->max_expense_category = $data->expense_category->category_name ?? "Nil";
        $this->max_expense_amount = $data->amount ?? 0;
    }

    protected function getStats(): array
    {
        $this->set_max_cat_amt();
        return [
            Stat::make('Accounts',Account::count())
            ->icon('heroicon-o-currency-dollar')->description('Total Accounts')->descriptionColor(Color::Amber),
            Stat::make('Expenses',fn()=>format_money(Expense::sum('expense_amount'),"PKR"))
                ->icon('heroicon-o-arrow-trending-down')->description('Expense this Month')->descriptionColor(Color::Red),
            Stat::make('Incomes',fn()=>format_money(Income::sum('income_amount'),"PKR"))
                ->icon('heroicon-o-arrow-trending-up')->description('Income this Month')->descriptionColor(Color::Green),
            Stat::make('Most Spent',format_money($this->max_expense_amount,'PKR'))
            ->description('Category : '. $this->max_expense_category)

        ];
    }
}
