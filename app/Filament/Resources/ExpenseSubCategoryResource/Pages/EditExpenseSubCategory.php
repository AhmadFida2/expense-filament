<?php

namespace App\Filament\Resources\ExpenseSubCategoryResource\Pages;

use App\Filament\Resources\ExpenseSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExpenseSubCategory extends EditRecord
{
    protected static string $resource = ExpenseSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
