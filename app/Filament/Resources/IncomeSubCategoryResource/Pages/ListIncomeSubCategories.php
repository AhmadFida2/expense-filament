<?php

namespace App\Filament\Resources\IncomeSubCategoryResource\Pages;

use App\Filament\Resources\IncomeSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncomeSubCategories extends ListRecords
{
    protected static string $resource = IncomeSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
