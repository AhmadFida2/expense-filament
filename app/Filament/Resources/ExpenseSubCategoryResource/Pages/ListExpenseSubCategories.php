<?php

namespace App\Filament\Resources\ExpenseSubCategoryResource\Pages;

use App\Filament\Resources\ExpenseSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExpenseSubCategories extends ListRecords
{
    protected static string $resource = ExpenseSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
