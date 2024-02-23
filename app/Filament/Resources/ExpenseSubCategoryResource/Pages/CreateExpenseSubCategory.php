<?php

namespace App\Filament\Resources\ExpenseSubCategoryResource\Pages;

use App\Filament\Resources\ExpenseSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExpenseSubCategory extends CreateRecord
{
    protected static string $resource = ExpenseSubCategoryResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
