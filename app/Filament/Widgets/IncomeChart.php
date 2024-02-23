<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use App\Models\Income;
use Filament\Widgets\ChartWidget;

class IncomeChart extends ChartWidget
{
    protected static ?string $heading = 'Top 5 Incomes';

    protected static ?string $maxHeight = '300px';

    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $data = Income::query()->groupBy('income_category_id')->selectRaw('sum(income_amount) as amount,income_category_id')->with('income_category')->orderBy('amount', 'DESC')->limit(5)->get();
        $cats = [];
        $vals = $data->pluck('amount')->toArray();
        $colors = [];
        for ($i=0;$i<count($vals);$i++)
            {
                $r = random_int(1, 200);
                $g = random_int(1, 200);
                $b = random_int(1, 200);
                $color = 'rgb(' . $r . ', ' . $g . ', ' . $b . ')';
                array_push($colors,$color);
            }

        foreach ($data as $datum) {
            array_push($cats, $datum->income_category->category_name);
        }


        return [
            'datasets' => [
                [
                    'label' => 'Income by Category',
                    'data' => $vals,
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $cats,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected static ?array $options = [
        'scales' => [
            'y' => ['display' => false],
            'x' => ['display' => false],
        ],
    ];
}
