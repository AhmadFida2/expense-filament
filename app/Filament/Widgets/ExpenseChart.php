<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class ExpenseChart extends ChartWidget
{
    protected static ?string $heading = 'Top 5 Expenses';

    protected static ?string $maxHeight = '300px';

    protected static ?string $pollingInterval = null;


    protected function getData(): array
    {
        $data = Expense::query()->groupBy('expense_category_id')->selectRaw('sum(expense_amount) as amount,expense_category_id')->with('expense_category')->orderBy('amount', 'DESC')->limit(5)->get();
        $cats = [];
        $vals = $data->pluck('amount')->toArray();
        $colors = [];
        for ($i = 0; $i < count($vals); $i++) {
            $r = random_int(1, 200);
            $g = random_int(1, 200);
            $b = random_int(1, 200);
            $color = 'rgb(' . $r . ', ' . $g . ', ' . $b . ')';
            array_push($colors, $color);
        }
        foreach ($data as $datum) {
            array_push($cats, $datum->expense_category->category_name);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Expense by Category',
                    'data' => $vals,
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $cats,

        ];
    }


    protected static ?array $options = [
        'scales' => [
            'y' => ['display' => false],
            'x' => ['display' => false],
        ],
    ];


    protected function getType(): string
    {
        return 'doughnut';
    }
}
