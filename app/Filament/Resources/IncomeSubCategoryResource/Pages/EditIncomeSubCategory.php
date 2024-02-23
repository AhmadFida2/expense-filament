<?php

namespace App\Filament\Resources\IncomeSubCategoryResource\Pages;

use App\Filament\Resources\IncomeSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncomeSubCategory extends EditRecord
{
    protected static string $resource = IncomeSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
