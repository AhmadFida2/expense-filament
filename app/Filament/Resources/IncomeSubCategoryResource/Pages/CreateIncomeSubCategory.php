<?php

namespace App\Filament\Resources\IncomeSubCategoryResource\Pages;

use App\Filament\Resources\IncomeSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIncomeSubCategory extends CreateRecord
{
    protected static string $resource = IncomeSubCategoryResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
